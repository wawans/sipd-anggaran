import type { ColumnDef } from '@tanstack/react-table'
import type { Model } from '@/types'
import { Checkbox } from '@/components/ui/checkbox'
import { DataTableColumnHeader } from '@/components/data-table'

import { DataTableRowActions } from './data-table-row-actions'
import { DataTableStatusActions } from '@/pages/workers/components/data-table-status-actions'

export const columns: ColumnDef<Model>[] = [
  {
    id: 'select',
    header: ({ table }) => (
      <Checkbox
        checked={
          table.getIsAllPageRowsSelected() ||
          (table.getIsSomePageRowsSelected() && 'indeterminate')
        }
        onCheckedChange={(value) => table.toggleAllPageRowsSelected(!!value)}
        aria-label='Select all'
        className='translate-y-[2px]'
      />
    ),
    cell: ({ row }) => (
      <Checkbox
        checked={row.getIsSelected()}
        onCheckedChange={(value) => row.toggleSelected(!!value)}
        aria-label='Select row'
        className='translate-y-[2px]'
      />
    ),
    enableSorting: false,
    enableHiding: false,
  },
  {
    accessorKey: 'id',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='ID' />
    ),
    cell: ({ row }) => <div className='w-[80px]'>{row.getValue('id')}</div>,
    meta: { className: 'ps-1', tdClassName: 'ps-3' },
  },
  {
    accessorKey: 'nama_sub_skpd',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama SKPD' />
    ),
    cell: ({ getValue }) => (
      <div className='whitespace-normal wrap-break-word'>{getValue() as string}</div>
    ),
    meta: {
      className: 'ps-1 w-fit',
      tdClassName: 'ps-3',
    },
  },
  {
    accessorKey: 'nama_sub_giat',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama Sub Kegiatan' />
    ),
    cell: ({ getValue }) => (
      <div className='whitespace-normal wrap-break-word'>{getValue() as string}</div>
    ),
    meta: {
      className: 'ps-1 w-fit',
      tdClassName: 'ps-3',
    },
  },
  {
    accessorKey: 'status_getter',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Active ?' />
    ),
    cell: ({ row }) => <DataTableStatusActions row={row} />,
    meta: { className: 'ps-1', tdClassName: 'ps-3' },
  },
  {
    id: 'actions',
    cell: ({ row }) => <DataTableRowActions row={row} />,
    meta: {
      thClassName: 'w-14',
    },
  },
]
