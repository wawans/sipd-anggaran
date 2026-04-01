'use client'

import { useState } from 'react'
import { useQueryClient } from '@tanstack/react-query'
import { useRouter } from '@tanstack/react-router'
import type { Model } from '@/types'
import { AlertTriangle } from 'lucide-react'
import { toast } from 'sonner'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { ConfirmDialog } from '@/components/confirm-dialog'

import { destroy, allQueryOptions } from './api'
import { useDataTable } from './data-table-provider'

type DataDeleteDialogProps = {
  open: boolean
  onOpenChange: (open: boolean) => void
  currentRow: Model
}

export function DatasDeleteDialog({
  open,
  onOpenChange,
  currentRow,
}: DataDeleteDialogProps) {
  const { entity } = useDataTable()

  const router = useRouter()
  const queryClient = useQueryClient()

  // @ts-expect-error no-unused-vars
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  const [value, setValue] = useState('')

  const handleDelete = () => {
    // if (value.trim() !== currentRow.username) return

    onOpenChange(false)

    toast.promise(destroy(currentRow.id), {
      loading: `Deleting ${entity}...`,
      success: () => {
        setValue('')

        queryClient.invalidateQueries({
          queryKey: allQueryOptions.queryKey,
          refetchType: 'all',
        })
        router.invalidate()

        return `Success`
      },
      error: 'Error',
    })
  }

  return (
    <ConfirmDialog
      open={open}
      onOpenChange={onOpenChange}
      handleConfirm={handleDelete}
      // disabled={isPending}
      title={
        <span className='text-destructive'>
          <AlertTriangle
            className='me-1 mb-1 inline-block stroke-destructive'
            size={18}
          />{' '}
          Delete this {entity}: {currentRow?.id} ?
        </span>
      }
      desc={
        <div className='space-y-4'>
          <p className='mb-2'>
            Are you sure you want to delete a {entity} with the ID{' '}
            <span className='font-bold'>{currentRow?.id}</span>?
            <br />
            This action will permanently remove the {entity} with the associated
            data from the system. This action cannot be undone.
          </p>

          <Alert variant='destructive'>
            <AlertTitle>Warning!</AlertTitle>
            <AlertDescription>
              Please be careful, this operation can not be rolled back.
            </AlertDescription>
          </Alert>
        </div>
      }
      confirmText='Delete'
      destructive
    />
  )
}
