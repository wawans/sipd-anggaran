import type { ColumnDef } from '@tanstack/react-table'
import { Suspense } from 'react'
import { DataTableSkeleton } from '@/components/data-table/skeleton'
import { Main } from '@/components/layout/main'
import { Page } from '@/components/layout/page'
import type { Model } from '@/types'
import { DataTablePrimaryButtons } from './components/data-table-primary-buttons'
import { DataTableProvider } from './components/data-table-provider'
import type { DataTableQueryOptionsType } from './components/data-table-provider'
import { DataTableSuspense } from './components/data-table-suspense'

export default function IndexPage({
  entity,
  columns,
  queryOptions,
  url,
}: {
  entity: string
  columns: ColumnDef<Model>[]
  queryOptions: DataTableQueryOptionsType
  url: string
}) {
  return (
    <DataTableProvider entity={entity} url={url} queryOptions={queryOptions}>
      <Page>
        <Main className='flex flex-1 flex-col gap-4 sm:gap-6' fluid>
          <div className='flex flex-wrap items-end justify-between gap-2'>
            <div>
              <h2 className='text-2xl font-bold tracking-tight'>{entity}</h2>
            </div>
            <DataTablePrimaryButtons />
          </div>
          <Suspense fallback={<DataTableSkeleton columns={columns} />}>
            <DataTableSuspense queryOptions={queryOptions} columns={columns} />
          </Suspense>
        </Main>
      </Page>
    </DataTableProvider>
  )
}
