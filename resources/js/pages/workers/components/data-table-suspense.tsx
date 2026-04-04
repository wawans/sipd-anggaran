import { useSuspenseQuery } from '@tanstack/react-query'
import type { ColumnDef } from '@tanstack/react-table'
import { CheckCircle, CircleOff } from 'lucide-react'
import type { Model } from '@/types'
import { DataTable } from './data-table'

const statuses = [
  {
    label: 'Active',
    value: '1' as const,
    icon: CheckCircle,
  },
  {
    label: 'Inactive',
    value: '0' as const,
    icon: CircleOff,
  },
]

export function DataTableSuspense({
  columns,
  queryOptions,
}: {
  columns: ColumnDef<Model>[]
  queryOptions: any
}) {
  const { data: query } = useSuspenseQuery(queryOptions)
  const rows = (query as { data: any[] }).data

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
