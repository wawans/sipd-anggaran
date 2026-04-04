import type { ColumnDef } from '@tanstack/react-table'
import { DataTableColumnHeader } from '@/components/data-table'
import { Checkbox } from '@/components/ui/checkbox'

import { numberFormat } from '@/lib/numberFormat'
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
    meta: { className: 'ps-0', tdClassName: 'ps-2' },
  },
  {
    accessorKey: 'nama_sub_skpd',
    label: 'Nama Sub SKPD',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama SKPD' />
    ),
    cell: ({ getValue, row: { original } }) => (
      <div className='wrap-break-word whitespace-normal'>
        {getValue() as string}
        <br />
        <span className='text-xs text-muted-foreground'>
          {original?.kode_sub_skpd as string}
        </span>
      </div>
    ),
    meta: {
      className: 'ps-0',
      tdClassName: 'ps-2',
    },
  },
  {
    accessorKey: 'nama_sub_giat',
    label: 'Nama Sub Giat',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama Sub Kegiatan' />
    ),
    cell: ({ getValue, row: { original } }) => (
      <div className='wrap-break-word whitespace-normal'>
        {getValue() as string}
        <br />
        <span className='text-xs text-muted-foreground'>
          {original?.kode_sub_giat as string}
        </span>
      </div>
    ),
    meta: {
      className: 'ps-0',
      tdClassName: 'ps-2',
    },
  },
  {
    accessorKey: 'nama_akun',
    label: 'Nama Akun',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama Akun' />
    ),
    cell: ({ getValue, row: { original } }) => (
      <div className='wrap-break-word whitespace-normal'>
        {getValue() as string}
        <br />
        <span className='text-xs text-muted-foreground'>
          {original?.kode_akun as string}
        </span>
      </div>
    ),
    meta: {
      className: 'ps-0',
      tdClassName: 'ps-2',
    },
  },
  {
    accessorKey: 'nama_standar_harga',
    label: 'Nama Standar Harga',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama Standar Harga' />
    ),
    cell: ({ getValue, row: { original } }) => (
      <div className='wrap-break-word whitespace-normal'>
        {getValue() as string}
        <br />
        <span className='text-xs text-muted-foreground'>
          {original?.kode_standar_harga as string}
        </span>
      </div>
    ),
    meta: {
      className: 'ps-0',
      tdClassName: 'ps-2',
    },
  },
  {
    accessorKey: 'spek',
    label: 'Spek',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Spek' />
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
    accessorKey: 'koefisien',
    label: 'Koefisien',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Koefisien' />
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
    accessorKey: 'harga_satuan',
    label: 'Harga Satuan',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Harga Satuan' />
    ),
    cell: ({ getValue }) => <>{numberFormat(getValue() as number)}</>,
    meta: { className: 'pe-0 text-right', tdClassName: 'pe-2' },
    filterFn: 'inNumberRange',
  },
  {
    accessorKey: 'total_harga',
    label: 'Total Harga',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Total Harga' />
    ),
    cell: ({ getValue }) => <>{numberFormat(getValue() as number)}</>,
    meta: { className: 'pe-0 text-right', tdClassName: 'pe-2' },
    filterFn: 'inNumberRange',
  },
]
