import { queryOptions, useQuery } from '@tanstack/react-query'
import type { ColumnDef } from '@tanstack/react-table'
import {
  getCoreRowModel,
  getFilteredRowModel,
  getPaginationRowModel,
  getSortedRowModel,
  useReactTable,
} from '@tanstack/react-table'
import { DataTableTable } from '@/components/data-table'
import { useAuth } from '@/context/auth-provider'
import axios from '@/lib/api'

// eslint-disable-next-line react-refresh/only-export-components
export const apiKeysTableQueryOptions = (userId: string | number) =>
  queryOptions({
    queryKey: ['api-keys', { userId }],
    queryFn: () => axios.get('/api/account/token').then((r) => r.data.data),
  })

const columns: ColumnDef<any>[] = [
  {
    accessorKey: 'name',
    header: 'Name',
  },
  {
    accessorKey: 'last_used_at',
    header: 'Last Used',
    cell: ({ getValue }) => {
      const value = getValue()

      return value ? new Date(value as string).toLocaleDateString() : '-'
    },
  },
  {
    accessorKey: 'expires_at',
    header: 'Expires',
    cell: ({ getValue }) => {
      const value = getValue()

      return value ? new Date(value as string).toLocaleDateString() : '-'
    },
  },
  {
    accessorKey: 'created_at',
    header: 'Created',
    cell: ({ getValue }) => {
      const value = getValue()

      return value ? new Date(value as string).toLocaleDateString() : '-'
    },
  },
]

export function ApiKeysTable() {
  const { user } = useAuth()

  const { data, isLoading } = useQuery(
    apiKeysTableQueryOptions(user?.id as string | number)
  )

  // eslint-disable-next-line react-hooks/incompatible-library
  const table = useReactTable({
    data,
    columns,
    getCoreRowModel: getCoreRowModel(),
    getFilteredRowModel: getFilteredRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getSortedRowModel: getSortedRowModel(),
    enableColumnFilters: false,
  })

  return (
    <div className='my-8'>
      <div className='mb-4'>
        <p>Your API Keys</p>
      </div>
      {(!isLoading || (data && (data as []).length > 0)) && (
        <DataTableTable table={table} />
      )}
    </div>
  )
}
