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
    label: 'ID',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='ID' />
    ),
    cell: ({ row }) => <div className='w-[80px]'>{row.getValue('id')}</div>,
    meta: { className: 'ps-0', tdClassName: 'ps-2' },
  },
  {
    accessorKey: 'nama_skpd',
    label: 'Nama SKPD',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama SKPD' />
    ),
    cell: ({ getValue, row: { original } }) => (
      <div className='min-w-[150px] wrap-break-word whitespace-normal lg:min-w-[250px]'>
        {getValue() as string}
        <br />
        <span className='text-xs text-muted-foreground'>
          {original?.kode_skpd as string}
        </span>
      </div>
    ),
    meta: { className: 'ps-0', tdClassName: 'ps-2' },
  },
  {
    accessorKey: 'nama_sub_skpd',
    label: 'Nama Sub SKPD',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama Sub SKPD' />
    ),
    cell: ({ getValue, row: { original } }) => (
      <div className='min-w-[150px] wrap-break-word whitespace-normal lg:min-w-[250px]'>
        {getValue() as string}
        <br />
        <span className='text-xs text-muted-foreground'>
          {original?.kode_sub_skpd as string}
        </span>
      </div>
    ),
    meta: { className: 'ps-0', tdClassName: 'ps-2' },
  },
  {
    accessorKey: 'nama_urusan',
    label: 'Nama Urusan',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama Urusan' />
    ),
    cell: ({ getValue, row: { original } }) => (
      <div className='min-w-[150px] wrap-break-word whitespace-normal lg:min-w-[250px]'>
        {getValue() as string}
        <br />
        <span className='text-xs text-muted-foreground'>
          {original?.kode_urusan as string}
        </span>
      </div>
    ),
    meta: { className: 'ps-0', tdClassName: 'ps-2' },
  },
  {
    accessorKey: 'nama_bidang_urusan',
    label: 'Nama Bidang Urusan',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama Bidang Urusan' />
    ),
    cell: ({ getValue, row: { original } }) => (
      <div className='min-w-[150px] wrap-break-word whitespace-normal lg:min-w-[250px]'>
        {getValue() as string}
        <br />
        <span className='text-xs text-muted-foreground'>
          {original?.kode_bidang_urusan as string}
        </span>
      </div>
    ),
    meta: { className: 'ps-0', tdClassName: 'ps-2' },
  },
  {
    accessorKey: 'nama_program',
    label: 'Nama Program',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama Program' />
    ),
    cell: ({ getValue, row: { original } }) => (
      <div className='min-w-[150px] wrap-break-word whitespace-normal lg:min-w-[250px]'>
        {getValue() as string}
        <br />
        <span className='text-xs text-muted-foreground'>
          {original?.kode_program as string}
        </span>
      </div>
    ),
    meta: { className: 'ps-0', tdClassName: 'ps-2' },
  },
  {
    accessorKey: 'nama_giat',
    label: 'Nama Giat',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama Giat' />
    ),
    cell: ({ getValue, row: { original } }) => (
      <div className='min-w-[150px] wrap-break-word whitespace-normal lg:min-w-[250px]'>
        {getValue() as string}
        <br />
        <span className='text-xs text-muted-foreground'>
          {original?.kode_giat as string}
        </span>
      </div>
    ),
    meta: { className: 'ps-0', tdClassName: 'ps-2' },
  },
  {
    accessorKey: 'nama_sub_giat',
    label: 'Nama Sub Giat',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Nama Sub Giat' />
    ),
    cell: ({ getValue, row: { original } }) => (
      <div className='min-w-[150px] wrap-break-word whitespace-normal lg:min-w-[250px]'>
        {getValue() as string}
        <br />
        <span className='text-xs text-muted-foreground'>
          {original?.kode_sub_giat as string}
        </span>
      </div>
    ),
    meta: { className: 'ps-0', tdClassName: 'ps-2' },
  },
  {
    accessorKey: 'pagu',
    label: 'Pagu Sub Giat',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Pagu Sub Giat' />
    ),
    cell: ({ getValue }) => <>{numberFormat(getValue() as number)}</>,
    meta: { className: 'pe-0 text-right', tdClassName: 'pe-2' },
    filterFn: 'inNumberRange',
  },
  {
    accessorKey: 'rincian',
    label: 'Pagu Rinci',
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title='Pagu Rinci' />
    ),
    cell: ({ getValue }) => <>{numberFormat(getValue() as number)}</>,
    meta: { className: 'pe-0 text-right', tdClassName: 'pe-2' },
    filterFn: 'inNumberRange',
  },
]
