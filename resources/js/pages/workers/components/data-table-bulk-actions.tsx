import { useMutation, useQueryClient } from '@tanstack/react-query'
import { useRouter } from '@tanstack/react-router'
import type { Table } from '@tanstack/react-table'
import { Trash2, CheckCircle, CircleOff } from 'lucide-react'
import { useState } from 'react'
import { toast } from 'sonner'
import { DataTableBulkActions as BulkActionsToolbar } from '@/components/data-table'
import { Button } from '@/components/ui/button'
import {
  Tooltip,
  TooltipContent,
  TooltipTrigger,
} from '@/components/ui/tooltip'
import axios from '@/lib/api'
import { sleep } from '@/lib/utils'
import type { Model } from '@/types'
import { DataTableMultiDeleteDialog } from './data-table-multi-delete-dialog'
import { useDataTable } from './data-table-provider'

type DataTableBulkActionsProps = {
  table: Table<Model>
}

export function DataTableBulkActions({ table }: DataTableBulkActionsProps) {
  const { entity, url, queryOptions } = useDataTable()

  const [showDeleteConfirm, setShowDeleteConfirm] = useState(false)
  const selectedRows = table.getFilteredSelectedRowModel().rows

  const router = useRouter()
  const queryClient = useQueryClient()
  const { mutateAsync } = useMutation({
    mutationFn: (data: { status: boolean; ids: number[] }) =>
      axios.put(url, {
        status_getter: data.status,
        ids: data.ids,
      }),
    onMutate: async (data) => {
      // Cancel outgoing queries
      await queryClient.cancelQueries(queryOptions.queryKey)

      // Optimistically update
      queryClient.setQueryData(
        queryOptions.queryKey,
        (queryResponse: { data: Model[] }) => {
          // console.log(prevItems)
          const prevItems: Model[] = queryResponse.data

          return {
            ...queryResponse,
            data: prevItems?.map((item: Model) =>
              data.ids.includes(item.id)
                ? // ? { ...item, { ...model, status_getter: !model.status_getter } }
                  // ? { ...item, ...model }
                  { ...item, status_getter: !item.status_getter }
                : item
            ),
          }
        }
      )
    },
    onSettled: () => {
      queryClient.invalidateQueries({
        queryKey: queryOptions.queryKey,
        // refetchType: 'all',
      })
      // router.invalidate()
    },
  })

  const handleBulkStatusChange = (status: boolean) => {
    const selectedEntries = selectedRows.map((row) => row.original?.id)

    toast.promise(mutateAsync({ status, ids: selectedEntries }), {
      loading: `${status ? 'Activating' : 'Deactivating'} workers...`,
      success: () => {
        table.resetRowSelection()

        return `${status ? 'Activated' : 'Deactivated'} ${selectedEntries.length} worker${selectedEntries.length > 1 ? 's' : ''}`
      },
      error: `Error ${status ? 'activating' : 'deactivating'} workers`,
    })
    table.resetRowSelection()
  }

  // @ts-expect-error @typescript-eslint/no-unused-vars
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  const handleBulkInvite = () => {
    const selectedEntries = selectedRows.map((row) => row.original)
    toast.promise(sleep(2000), {
      loading: 'Inviting entries...',
      success: () => {
        table.resetRowSelection()

        return `Invited ${selectedEntries.length} entry${selectedEntries.length > 1 ? 's' : ''}`
      },
      error: 'Error inviting entries',
    })
    table.resetRowSelection()
  }

  return (
    <>
      <BulkActionsToolbar table={table} entityName='item'>
        <Tooltip>
          <TooltipTrigger asChild>
            <Button
              variant='outline'
              size='icon'
              onClick={() => handleBulkStatusChange(true)}
              className='size-8'
              aria-label='Enable workers'
              title='Enable workers'
            >
              <CheckCircle />
              <span className='sr-only'>Enable workers</span>
            </Button>
          </TooltipTrigger>
          <TooltipContent>
            <p>Enable workers</p>
          </TooltipContent>
        </Tooltip>

        <Tooltip>
          <TooltipTrigger asChild>
            <Button
              variant='outline'
              size='icon'
              onClick={() => handleBulkStatusChange(false)}
              className='size-8'
              aria-label='Disable workers'
              title='Disable workers'
            >
              <CircleOff />
              <span className='sr-only'>Disable workers</span>
            </Button>
          </TooltipTrigger>
          <TooltipContent>
            <p>Disable workers</p>
          </TooltipContent>
        </Tooltip>

        <Tooltip>
          <TooltipTrigger asChild>
            <Button
              variant='destructive'
              size='icon'
              onClick={() => setShowDeleteConfirm(true)}
              className='size-8'
              aria-label={`Delete selected ${entity}(s)`}
              title={`Delete selected ${entity}(s)`}
            >
              <Trash2 />
              <span className='sr-only'>Delete selected {entity}(s)</span>
            </Button>
          </TooltipTrigger>
          <TooltipContent>
            <p>Delete selected {entity}(s)</p>
          </TooltipContent>
        </Tooltip>
      </BulkActionsToolbar>

      <DataTableMultiDeleteDialog
        table={table}
        open={showDeleteConfirm}
        onOpenChange={setShowDeleteConfirm}
      />
    </>
  )
}
