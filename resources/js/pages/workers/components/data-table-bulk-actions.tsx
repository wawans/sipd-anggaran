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
import { sleep } from '@/lib/utils'
import type { Model } from '@/types'

import { DataTableMultiDeleteDialog } from './data-table-multi-delete-dialog'
import { useDataTable } from './data-table-provider'

type DataTableBulkActionsProps = {
  table: Table<Model>
}

export function DataTableBulkActions({ table }: DataTableBulkActionsProps) {
  const { entity } = useDataTable()

  const [showDeleteConfirm, setShowDeleteConfirm] = useState(false)
  const selectedRows = table.getFilteredSelectedRowModel().rows

  // @ts-expect-error @typescript-eslint/no-unused-vars

  const handleBulkStatusChange = (status: 'active' | 'inactive') => {
    const selectedEntries = selectedRows.map((row) => row.original)
    toast.promise(sleep(2000), {
      loading: `${status === 'active' ? 'Activating' : 'Deactivating'} entries...`,
      success: () => {
        table.resetRowSelection()

        return `${status === 'active' ? 'Activated' : 'Deactivated'} ${selectedEntries.length} entry${selectedEntries.length > 1 ? 's' : ''}`
      },
      error: `Error ${status === 'active' ? 'activating' : 'deactivating'} entries`,
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
              onClick={() => handleBulkStatusChange('active')}
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
              onClick={() => handleBulkStatusChange('inactive')}
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
