import type { Table as ReactTable } from '@tanstack/react-table'

import { flexRender } from '@tanstack/react-table'
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { cn } from '@/lib/utils'
import { ColumnFilter } from './column-filter'

type DataTableTableProps<TData> = {
  table: ReactTable<TData>
  className?: string
  tdClassName?: string
  thClassName?: string
  tdRowClassName?: string
  thRowClassName?: string
  wrapperClassName?: string
}

export function DataTableTable<TData>({
  table,
  className,
  tdClassName,
  thClassName,
  tdRowClassName,
  thRowClassName,
  wrapperClassName,
}: DataTableTableProps<TData>) {
  return (
    <div className={cn('overflow-hidden rounded-md border', wrapperClassName)}>
      <Table className={cn(className)}>
        <TableHeader>
          {table.getHeaderGroups().map((headerGroup) => (
            <TableRow key={headerGroup.id} className={cn(thRowClassName)}>
              {headerGroup.headers.map((header) => {
                return (
                  <TableHead
                    key={header.id}
                    colSpan={header.colSpan}
                    className={cn(
                      thClassName,
                      header.column.columnDef.meta?.className,
                      header.column.columnDef.meta?.thClassName
                    )}
                  >
                    {header.isPlaceholder
                      ? null
                      : flexRender(
                          header.column.columnDef.header,
                          header.getContext()
                        )}
                    {header.column.getCanFilter() ? (
                      <div
                        className={cn(
                          header.column.getCanSort() ? 'px-2.5' : 'px-3',
                          'pb-1'
                        )}
                      >
                        <ColumnFilter column={header.column} />
                      </div>
                    ) : null}
                  </TableHead>
                )
              })}
            </TableRow>
          ))}
        </TableHeader>
        <TableBody>
          {table.getRowModel().rows?.length ? (
            table.getRowModel().rows.map((row) => (
              <TableRow
                key={row.id}
                data-state={row.getIsSelected() && 'selected'}
                className={cn(tdRowClassName)}
              >
                {row.getVisibleCells().map((cell) => (
                  <TableCell
                    key={cell.id}
                    className={cn(
                      tdClassName,
                      cell.column.columnDef.meta?.className,
                      cell.column.columnDef.meta?.tdClassName
                    )}
                  >
                    {flexRender(cell.column.columnDef.cell, cell.getContext())}
                  </TableCell>
                ))}
              </TableRow>
            ))
          ) : (
            <TableRow>
              <TableCell
                colSpan={table.getAllColumns().length}
                className='h-24 text-center'
              >
                No results.
              </TableCell>
            </TableRow>
          )}
        </TableBody>
      </Table>
    </div>
  )
}
