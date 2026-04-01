'use client'

import { useQueryClient } from '@tanstack/react-query'
import { useRouter } from '@tanstack/react-router'
import type { Table } from '@tanstack/react-table'
import { AlertTriangle } from 'lucide-react'
import { useState } from 'react'
import { toast } from 'sonner'
import { ConfirmDialog } from '@/components/confirm-dialog'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import type { Model } from '@/types'

import { useDataTable } from './data-table-provider'

type DataTableMultiDeleteDialogProps = {
  open: boolean
  onOpenChange: (open: boolean) => void
  table: Table<Model>
}

const CONFIRM_WORD = 'DELETE'

export function DataTableMultiDeleteDialog({
  open,
  onOpenChange,
  table,
}: DataTableMultiDeleteDialogProps) {
  const { entity, destroys, queryOptions } = useDataTable()
  const router = useRouter()
  const queryClient = useQueryClient()
  const [value, setValue] = useState('')

  const selectedRows = table.getFilteredSelectedRowModel().rows

  const handleDelete = () => {
    if (value.trim() !== CONFIRM_WORD) {
      toast.error(`Please type "${CONFIRM_WORD}" to confirm.`)

      return
    }

    onOpenChange(false)

    const selectedEntries = selectedRows.map((row) => row.original?.id)
    toast.promise(destroys({ ids: selectedEntries }), {
      loading: `Deleting ${entity}...`,
      success: () => {
        setValue('')
        table.resetRowSelection()

        queryClient.invalidateQueries({
          queryKey: queryOptions.queryKey,
          refetchType: 'all',
        })
        router.invalidate()

        return `Deleted ${selectedRows.length} ${
          selectedRows.length > 1 ? entity + '' : entity
        }`
      },
      error: 'Error',
    })
  }

  return (
    <ConfirmDialog
      open={open}
      onOpenChange={onOpenChange}
      handleConfirm={handleDelete}
      disabled={value.trim() !== CONFIRM_WORD}
      title={
        <span className='text-destructive'>
          <AlertTriangle
            className='me-1 inline-block stroke-destructive'
            size={18}
          />{' '}
          Delete {selectedRows.length}{' '}
          {selectedRows.length > 1 ? entity + '' : entity}
        </span>
      }
      desc={
        <div className='space-y-4'>
          <p className='mb-2'>
            Are you sure you want to delete the selected {entity}? <br />
            This action cannot be undone.
          </p>

          <Label className='my-4 flex flex-col items-start gap-1.5'>
            <span className=''>Confirm by typing "{CONFIRM_WORD}":</span>
            <Input
              value={value}
              onChange={(e) => setValue(e.target.value)}
              placeholder={`Type "${CONFIRM_WORD}" to confirm.`}
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
      confirmText='Delete'
      destructive
    />
  )
}
