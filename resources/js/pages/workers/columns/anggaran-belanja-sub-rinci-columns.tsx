import type { ColumnDef } from '@tanstack/react-table'
import { DataTableColumnHeader } from '@/components/data-table'
import { Checkbox } from '@/components/ui/checkbox'
import type { Model } from '@/types'

import { DataTableRowActions } from '../components/data-table-row-actions'
import { DataTableStatusActions } from '../components/data-table-status-actions'

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
    meta: { className: 'ps-0', tdClassName: 'ps-2' },
  },
  {
    accessorKey: 'nama_sub_skpd',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama SKPD' />
    ),
    cell: ({ getValue }) => (
      <div className='wrap-break-word whitespace-normal'>
        {getValue() as string}
      </div>
    ),
    meta: {
      className: 'ps-0',
      tdClassName: 'ps-2',
    },
  },
  {
    accessorKey: 'nama_sub_giat',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama Sub Kegiatan' />
    ),
    cell: ({ getValue }) => (
      <div className='wrap-break-word whitespace-normal'>
        {getValue() as string}
      </div>
    ),
    meta: {
      className: 'ps-0',
      tdClassName: 'ps-2',
    },
  },
  {
    accessorKey: 'status_getter',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Active ?' />
    ),
    cell: ({ row }) => <DataTableStatusActions row={row} />,
    meta: { className: 'ps-0', tdClassName: 'ps-2' },
    filterFn: 'weakEquals',
    enableColumnFilter: false,
  },
  {
    id: 'actions',
    cell: ({ row }) => <DataTableRowActions row={row} />,
    meta: {
      thClassName: 'w-14',
    },
  },
]
