import { zodResolver } from '@hookform/resolvers/zod'
import { useMutation, useQueryClient } from '@tanstack/react-query'
import type { AxiosError } from 'axios'
import { useState } from 'react'
import { useForm } from 'react-hook-form'
import { toast } from 'sonner'
import { z } from 'zod'
import { Button } from '@/components/ui/button'

import {
  Form,
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'

import { useAuth } from '@/context/auth-provider'
import axios from '@/lib/api'
import { blank } from '@/lib/blank'
import type { LaravelValidationError } from '@/types'
import { apiKeysTableQueryOptions } from './api-keys-table'

const formSchema = z.object({
  name: z
    .string()
    .min(1, 'Please enter your token name.')
    .min(2, 'Name must be at least 2 characters.')
    .max(30, 'Name must not be longer than 30 characters.'),
})

type FormValues = z.infer<typeof formSchema>

export function ApiKeysForm() {
  const { user } = useAuth()

  const form = useForm<FormValues>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      name: '',
    },
  })

  const [token, setToken] = useState<string | null>(null)

  const queryClient = useQueryClient()
  const { mutateAsync, isPending } = useMutation({
    mutationFn: (data: FormValues) =>
      axios.post('/api/account/token', data).then((r) => r.data),
    onSuccess: (data) => {
      setToken(data?.data?.token)
    },
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
    onSettled: () => {
      queryClient.invalidateQueries({
        queryKey: apiKeysTableQueryOptions(user?.id as string | number)
          .queryKey,
      })
    },
  })

  function onSubmit(data: FormValues) {
    mutateAsync(data).then(() => form.reset())
  }

  return (
    <Form {...form}>
      {!blank(token) ? (
        <div>
          <FormItem>
            <div className='mb-4'>
              <FormLabel>Copy and secure this token:</FormLabel>
              <FormControl>
                <div className='my-2 flex h-9 w-full min-w-0 items-center space-x-2'>
                  <div className='grow-1 rounded-md border border-input bg-transparent px-3 py-1 text-base'>
                    <pre>
                      <code>{token}</code>
                    </pre>
                  </div>
                  {/* <Button variant='outline' size='icon' className='size-8.5' type='button' onClick={() => { copy(token as string); }}>
                    <CopyIcon />
                  </Button> */}
                </div>
              </FormControl>
              <FormDescription>
                After closed, You won't be able to view this plain token again.
              </FormDescription>
            </div>
          </FormItem>
          <div>
            <Button
              type='button'
              onClick={() => {
                setToken(null)
              }}
            >
              Close
            </Button>
          </div>
        </div>
      ) : (
        <form onSubmit={form.handleSubmit(onSubmit)} className='space-y-8'>
          <FormField
            disabled={isPending}
            control={form.control}
            name='name'
            render={({ field }) => (
              <FormItem>
                <FormLabel>Name</FormLabel>
                <FormControl>
                  <Input placeholder='Your token name' {...field} />
                </FormControl>
                <FormDescription>
                  This is the name that will be displayed on your api keys.
                </FormDescription>
                <FormMessage />
              </FormItem>
            )}
          />

          <Button disabled={isPending} type='submit'>
            Create token
          </Button>
        </form>
      )}
    </Form>
  )
}
