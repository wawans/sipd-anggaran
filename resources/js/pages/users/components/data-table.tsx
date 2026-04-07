import { useSuspenseQuery } from '@tanstack/react-query'
import {
  getCoreRowModel,
  getFacetedRowModel,
  getFacetedUniqueValues,
  getFilteredRowModel,
  getPaginationRowModel,
  getSortedRowModel,
  useReactTable,
} from '@tanstack/react-table'
import type {
  ColumnFiltersState,
  PaginationState,
  SortingState,
  VisibilityState,
} from '@tanstack/react-table'
import { useState } from 'react'
import {
  DataTablePagination,
  DataTableTable,
  DataTableToolbar,
} from '@/components/data-table'
import type { NavigateFn } from '@/hooks/use-table-url-state'
import { cn } from '@/lib/utils'

import type { User } from '@/types'
import { DataTableBulkActions } from './data-table-bulk-actions'
import { columns } from './data-table-columns'
import { dataTableQueryOptions } from './data-table-provider'

// @ts-expect-error @typescript-eslint/no-unused-vars
// eslint-disable-next-line @typescript-eslint/no-unused-vars
type DataTableProps = {
  data?: User[]
  search?: Record<string, unknown>
  navigate?: NavigateFn
}

export function DataTable() {
  const { data } = useSuspenseQuery(dataTableQueryOptions)

  // Local UI-only states
  const [rowSelection, setRowSelection] = useState({})
  const [columnVisibility, setColumnVisibility] = useState<VisibilityState>({})
  const [sorting, setSorting] = useState<SortingState>([])

  // Local state management for table (uncomment to use local-only state, not synced with URL)
  const [columnFilters, onColumnFiltersChange] = useState<ColumnFiltersState>(
    []
  )
  const [pagination, onPaginationChange] = useState<PaginationState>({
    pageIndex: 0,
    pageSize: 10,
  })

  // Synced with URL states (keys/defaults mirror users route search schema)
  // const {
  //   columnFilters,
  //   onColumnFiltersChange,
  //   pagination,
  //   onPaginationChange,
  //   ensurePageInRange,
  // } = useTableUrlState({
  //   search,
  //   navigate,
  //   pagination: { defaultPage: 1, defaultPageSize: 10 },
  //   globalFilter: { enabled: false },
  //   columnFilters: [
  //     // username per-column text filter
  //     { columnId: 'username', searchKey: 'username', type: 'string' },
  //     { columnId: 'status', searchKey: 'status', type: 'array' },
  //     { columnId: 'role', searchKey: 'role', type: 'array' },
  //   ],
  // })

  // eslint-disable-next-line react-hooks/incompatible-library
  const table = useReactTable({
    data,
    columns,
    state: {
      sorting,
      pagination,
      rowSelection,
      columnFilters,
      columnVisibility,
    },
    enableRowSelection: true,
    enableColumnFilters: false,
    onPaginationChange,
    onColumnFiltersChange,
    onRowSelectionChange: setRowSelection,
    onSortingChange: setSorting,
    onColumnVisibilityChange: setColumnVisibility,
    getPaginationRowModel: getPaginationRowModel(),
    getCoreRowModel: getCoreRowModel(),
    getFilteredRowModel: getFilteredRowModel(),
    getSortedRowModel: getSortedRowModel(),
    getFacetedRowModel: getFacetedRowModel(),
    getFacetedUniqueValues: getFacetedUniqueValues(),
  })

  return (
    <div
      className={cn(
        'max-sm:has-[div[role="toolbar"]]:mb-16', // Add margin bottom to the table on mobile when the toolbar is visible
        'flex flex-1 flex-col gap-4'
      )}
    >
      <DataTableToolbar
        table={table}
        searchPlaceholder='Filter users...'
        searchKey='name'
      />
      <DataTableTable
        table={table}
        tdClassName='bg-background group-hover/row:bg-muted group-data-[state=selected]/row:bg-muted'
        thClassName='bg-background group-hover/row:bg-muted group-data-[state=selected]/row:bg-muted'
        tdRowClassName='group/row'
        thRowClassName='group/row'
      />

      <DataTablePagination table={table} className='mt-auto' />
      <DataTableBulkActions table={table} />
    </div>
  )
}
