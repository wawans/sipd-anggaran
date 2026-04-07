'use client'

import { useMutation, useQueryClient } from '@tanstack/react-query'
import type { AxiosError } from 'axios'
import { AlertTriangle } from 'lucide-react'
import { useState } from 'react'
import { toast } from 'sonner'
import { ConfirmDialog } from '@/components/confirm-dialog'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Spinner } from '@/components/ui/spinner'
import axios from '@/lib/api'
import { dataTableQueryOptions } from '@/pages/users/components/data-table-provider'
import type { LaravelValidationError, User } from '@/types'
// import { showSubmittedData } from '@/lib/show-submitted-data'

type UserDeleteDialogProps = {
  open: boolean
  onOpenChange: (open: boolean) => void
  currentRow: User
}

export function DataTableDeleteDialog({
  open,
  onOpenChange,
  currentRow,
}: UserDeleteDialogProps) {
  const [value, setValue] = useState('')

  const queryClient = useQueryClient()
  const { mutate, isPending } = useMutation({
    mutationFn: () => axios.delete('/api/user/' + currentRow.id),
    onSuccess: () => {
      toast.success('Success!', { description: 'The user has been deleted.' })
      onOpenChange(false)
    },
    onSettled: () => {
      queryClient.invalidateQueries({
        queryKey: dataTableQueryOptions.queryKey,
        refetchType: 'all',
      })
    },
    onError: ({ response }: AxiosError<LaravelValidationError>) => {
      if (response?.status === 422) {
        if (response?.data?.message) {
          toast.error('Error!', {
            description: response?.data?.message || 'Something went wrong.',
          })
        }
      } else {
        toast.error('Error!', {
          description: response?.statusText || 'Something went wrong',
        })
      }
    },
  })

  const handleDelete = () => {
    if (value.trim() !== currentRow.email) {
      return
    }

    mutate()
  }

  return (
    <ConfirmDialog
      open={open}
      onOpenChange={onOpenChange}
      handleConfirm={handleDelete}
      disabled={value.trim() !== currentRow.email}
      isLoading={isPending}
      title={
        <span className='text-destructive'>
          <AlertTriangle
            className='me-1 inline-block stroke-destructive'
            size={18}
          />{' '}
          Delete User
        </span>
      }
      desc={
        <div className='space-y-4'>
          <p className='mb-2'>
            Are you sure you want to delete{' '}
            <span className='font-bold'>{currentRow.email}</span>?
            <br />
            This action will permanently remove the user from the system. This
            cannot be undone.
          </p>

          <Label className='my-2'>
            Email:
            <Input
              value={value}
              onChange={(e) => setValue(e.target.value)}
              placeholder='Enter email to confirm deletion.'
            />
          </Label>

          <Alert variant='destructive'>
            <AlertTitle>Warning!</AlertTitle>
            <AlertDescription>
              Please be careful, this operation can not be rolled back.
            </AlertDescription>
          </Alert>
        </div>
      }
      confirmText={isPending ? <Spinner /> : 'Delete'}
      destructive
    />
  )
}
