import type { ColumnDef } from '@tanstack/react-table'
import { DataTableColumnHeader } from '@/components/data-table'
import { Checkbox } from '@/components/ui/checkbox'
import type { Model } from '@/types'

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
    meta: { className: 'ps-0 w-[80px]', tdClassName: 'ps-2' },
  },
  {
    accessorKey: 'tahun',
    label: 'Tahun',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Tahun' />
    ),
    cell: ({ getValue }) => (
      <div className='wrap-break-word whitespace-normal'>
        {getValue() as string}
      </div>
    ),
    meta: {
      className: 'ps-0 w-[80px]',
      tdClassName: 'ps-2',
    },
  },
  {
    accessorKey: 'kode_sub_giat',
    label: 'Kode Sub Kegiatan',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Kode Sub Kegiatan' />
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
    label: 'Nama Sub Kegiatan',
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
]
