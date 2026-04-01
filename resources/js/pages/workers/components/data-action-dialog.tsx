'use client'

import { zodResolver } from '@hookform/resolvers/zod'
import { useMutation, useQueryClient } from '@tanstack/react-query'
import { useRouter } from '@tanstack/react-router'
import type { AxiosError } from 'axios'
import { useForm } from 'react-hook-form'
import { toast } from 'sonner'
import { z } from 'zod'
import { Button } from '@/components/ui/button'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { LoadingSpinner } from '@/components/ui/loading-spinner'
import { stringToSlug } from '@/lib/stringToSlug.ts'
import type { LaravelValidationError, Model } from '@/types'

import { useDataTable } from './data-table-provider'

const formSchema = z.object({
  nama: z.string().min(1, 'nama status is required.'),
})

type DataActionForm = z.infer<typeof formSchema>

type DataActionDialogProps = {
  currentRow?: Model
  open: boolean
  onOpenChange: (open: boolean) => void
}

export function DataActionDialog({
  currentRow,
  open,
  onOpenChange,
}: DataActionDialogProps) {
  const { entity, create, update, queryOptions } = useDataTable()

  const isEdit = !!currentRow
  const form = useForm<DataActionForm>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      nama: '',
      ...(isEdit ? { ...currentRow } : {}),
    },
  })

  const router = useRouter()
  const queryClient = useQueryClient()
  const { mutateAsync, isPending } = useMutation({
    mutationFn: (data: DataActionForm) =>
      isEdit ? update(currentRow.id, data) : create(data),
    onError: ({ response }: AxiosError<LaravelValidationError>) => {
      if (response?.status === 422) {
        if (response?.data?.errors) {
          for (const [key, value] of Object.entries(response.data.errors)) {
            form.setError(key as keyof z.infer<typeof formSchema>, {
              type: 'server',
              message: value[0] || 'Invalid',
            })
          }
        }

        if (response?.data?.message) {
          toast.error('Error!', {
            description: response?.data?.message || 'Something went wrong.',
          })
        }
      } else {
        toast.error('Error!', { description: 'Something went wrong' })
      }
    },
    onSuccess: () => {
      onOpenChange(false)
    },
    onSettled: () => {
      queryClient.invalidateQueries({
        queryKey: queryOptions.queryKey,
        refetchType: 'all',
      })
      router.invalidate()
    },
  })

  const onSubmit = (values: DataActionForm) => {
    mutateAsync(values).then(() => {
      form.reset()
    })
  }

  const fields: { name: Partial<keyof DataActionForm>; label: string }[] = [
    { name: 'nama', label: 'Nama Status' },
  ]

  const formName = stringToSlug(entity + ' form')

  return (
    <Dialog
      open={open}
      onOpenChange={(state) => {
        form.reset()
        onOpenChange(state)
      }}
    >
      <DialogContent className='sm:max-w-xl'>
        <DialogHeader className='text-start'>
          <DialogTitle>
            {isEdit ? 'Edit ' + entity : 'Add New ' + entity}
          </DialogTitle>
          <DialogDescription>
            {isEdit
              ? `Update the ${entity} here. `
              : `Create new ${entity} here. `}
            Click save when you&apos;re done.
          </DialogDescription>
        </DialogHeader>
        <div className='h-105 w-[calc(100%+0.75rem)] overflow-y-auto py-1 pe-3'>
          <Form {...form}>
            <form
              id={formName}
              onSubmit={form.handleSubmit(onSubmit)}
              className='space-y-4 px-0.5'
            >
              {fields.map(({ name, label }) => (
                <FormField
                  key={name}
                  control={form.control}
                  name={name}
                  render={({ field }) => (
                    <FormItem className=''>
                      <FormLabel className=''>{label}</FormLabel>
                      <FormControl>
                        <Input className='' autoComplete='off' {...field} />
                      </FormControl>
                      <FormMessage className='' />
                    </FormItem>
                  )}
                />
              ))}
            </form>
          </Form>
        </div>
        <DialogFooter>
          <Button disabled={isPending} type='submit' form={formName}>
            {isPending && <LoadingSpinner className='size-4' />}
            {isEdit ? 'Save changes' : 'Save'}
          </Button>
        </DialogFooter>
      </DialogContent>
    </Dialog>
  )
}
