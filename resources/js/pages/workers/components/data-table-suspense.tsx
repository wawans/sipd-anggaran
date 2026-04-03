import { useSuspenseQuery } from '@tanstack/react-query'
import type { ColumnDef } from '@tanstack/react-table'
import type { Model } from '@/types'
import { statuses } from '../index'
import { DataTable } from './data-table'

export function DataTableSuspense({
  columns,
  queryOptions,
}: {
  columns: ColumnDef<Model>[]
  queryOptions: any
}) {
  const { data: query } = useSuspenseQuery(queryOptions)
  const rows = query.data

  return (
    <DataTable
      data={rows}
      columns={columns}
      filters={[
        {
          columnId: 'status_getter',
          title: 'Status',
          options: statuses,
        },
      ]}
    />
  )
}
