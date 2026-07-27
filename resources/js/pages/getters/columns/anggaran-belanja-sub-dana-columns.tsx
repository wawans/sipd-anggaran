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
    accessorKey: 'id_jadwal',
    label: 'ID Jadwal',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='ID Jadwal' />
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
    accessorKey: 'nama_dana',
    label: 'Nama Dana',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama Dana' />
    ),
    cell: ({ getValue, row: { original } }) => (
      <div className='min-w-[150px] wrap-break-word whitespace-normal lg:min-w-[250px]'>
        {getValue() as string}
        <br />
        <span className='text-xs text-muted-foreground'>
          {original?.kode_dana as string}
        </span>
      </div>
    ),
    meta: { className: 'ps-0', tdClassName: 'ps-2' },
  },
  {
    accessorKey: 'pagu_dana',
    label: 'Pagu Dana',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Pagu Dana' />
    ),
    cell: ({ getValue }) => <>{numberFormat(getValue() as number)}</>,
    meta: { className: 'pe-0 text-right', tdClassName: 'pe-2' },
    filterFn: 'inNumberRange',
  },
]
