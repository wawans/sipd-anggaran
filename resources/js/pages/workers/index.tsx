import { useSuspenseQuery } from '@tanstack/react-query'
// import { getRouteApi } from '@tanstack/react-router'
import type { ColumnDef } from '@tanstack/react-table'
import { CheckCircle, CircleOff } from 'lucide-react'
import { Main } from '@/components/layout/main'
import { Page } from '@/components/layout/page'
import type { Model } from '@/types'
import { DataTable } from './components/data-table'
import type { filter } from './components/data-table'
import { DataTableDialogs } from './components/data-table-dialogs'
import { DataTablePrimaryButtons } from './components/data-table-primary-buttons'
import { DataTableProvider } from './components/data-table-provider'

export const statuses = [
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

export default function IndexPage({
  entity,
  columns,
  filters = [],
  queryOptions,
  url,
}: {
  entity: string
  columns: ColumnDef<Model>[]
  filters?: filter[]
  queryOptions: any
  url: string
}) {
  // const search = route.useSearch()
  // const navigate = route.useNavigate()

  const { data: query } = useSuspenseQuery(queryOptions)
  const rows = query.data

  return (
    <DataTableProvider entity={entity} url={url} queryOptions={queryOptions}>
      <Page>
        <Main className='flex flex-1 flex-col gap-4 sm:gap-6' fluid>
          <div className='flex flex-wrap items-end justify-between gap-2'>
            <div>
              <h2 className='text-2xl font-bold tracking-tight'>{entity}</h2>
              <p className='text-muted-foreground'>
                Manage worker {entity} and their information here.
              </p>
            </div>
            <DataTablePrimaryButtons />
          </div>
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
        </Main>

        <DataTableDialogs />
      </Page>
    </DataTableProvider>
  )
}
