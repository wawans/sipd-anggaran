import { useSuspenseQuery } from '@tanstack/react-query'
import type { ColumnDef } from '@tanstack/react-table'
import type { Model } from '@/types'
import { DataTable } from './data-table'
import type { DataTableQueryOptionsType } from './data-table-provider'

export function DataTableSuspense({
  columns,
  queryOptions,
}: {
  columns: ColumnDef<Model>[]
  queryOptions: DataTableQueryOptionsType
}) {
  const { data: query } = useSuspenseQuery(queryOptions)
  const rows = query.data

  return <DataTable data={rows} columns={columns} />
}
