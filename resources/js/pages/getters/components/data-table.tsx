import type {
  ColumnDef,
  ColumnFiltersState,
  PaginationState,
  SortingState,
  VisibilityState,
} from '@tanstack/react-table'
import {
  getCoreRowModel,
  getFacetedMinMaxValues,
  getFacetedRowModel,
  getFacetedUniqueValues,
  getFilteredRowModel,
  getPaginationRowModel,
  getSortedRowModel,
  useReactTable,
} from '@tanstack/react-table'
import { useState } from 'react'
import {
  DataTablePagination,
  DataTableToolbar,
  DataTableTable,
} from '@/components/data-table'

import type { NavigateFn } from '@/hooks/use-table-url-state'
import { cn } from '@/lib/utils'
import type { Model } from '@/types'

export type filter = {
  columnId: string
  title: string
  options: {
    label: string
    value: string
    icon?: React.ComponentType<{ className?: string }>
  }[]
}

type DataTableProps = {
  data: Model[]
  columns: ColumnDef<Model>[]
  filters?: filter[]
  toolbar?: React.ReactNode
  search?: Record<string, unknown>
  navigate?: NavigateFn
}

export function DataTable({ data, columns, toolbar }: DataTableProps) {
  // Local UI-only states
  const [rowSelection, setRowSelection] = useState({})
  const [sorting, setSorting] = useState<SortingState>([])
  const [columnVisibility, setColumnVisibility] = useState<VisibilityState>({})

  // Local state management for table (uncomment to use local-only state, not synced with URL)
  const [globalFilter, onGlobalFilterChange] = useState('')
  const [columnFilters, onColumnFiltersChange] = useState<ColumnFiltersState>(
    []
  )
  const [pagination, onPaginationChange] = useState<PaginationState>({
    pageIndex: 0,
    pageSize: 10,
  })

  // eslint-disable-next-line react-hooks/incompatible-library
  const table = useReactTable({
    data,
    columns,
    state: {
      sorting,
      columnVisibility,
      rowSelection,
      columnFilters,
      globalFilter,
      pagination,
    },
    enableRowSelection: true,
    enableColumnFilters: true,
    onRowSelectionChange: setRowSelection,
    onSortingChange: setSorting,
    onColumnVisibilityChange: setColumnVisibility,
    getCoreRowModel: getCoreRowModel(),
    getFilteredRowModel: getFilteredRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getSortedRowModel: getSortedRowModel(),
    getFacetedRowModel: getFacetedRowModel(),
    getFacetedUniqueValues: getFacetedUniqueValues(),
    getFacetedMinMaxValues: getFacetedMinMaxValues(),
    onPaginationChange,
    onGlobalFilterChange,
    onColumnFiltersChange,
  })

  return (
    <div
      className={cn(
        'max-sm:has-[div[role="toolbar"]]:mb-16', // Add margin bottom to the table on mobile when the toolbar is visible
        'flex flex-1 flex-col gap-4'
      )}
    >
      <DataTableToolbar table={table} searchPlaceholder='Search ...'>
        {toolbar}
      </DataTableToolbar>
      <DataTableTable table={table} />
      <DataTablePagination table={table} className='mt-auto' />
    </div>
  )
}
