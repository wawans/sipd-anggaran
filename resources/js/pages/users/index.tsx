import { Suspense } from 'react'
import { DataTableSkeleton } from '@/components/data-table/skeleton'
import { Main } from '@/components/layout/main'
import { Page } from '@/components/layout/page'
import { DataTable } from './components/data-table'
import { columns } from './components/data-table-columns'
import { DataTableDialogs } from './components/data-table-dialogs'
import { DataTablePrimaryButtons } from './components/data-table-primary-buttons'
import { DataTableProvider } from './components/data-table-provider'

export default function Index() {
  return (
    <DataTableProvider>
      <Page>
        <Main className='flex flex-1 flex-col gap-4 sm:gap-6'>
          <div className='flex flex-wrap items-end justify-between gap-2'>
            <div>
              <h2 className='text-2xl font-bold tracking-tight'>User List</h2>
              <p className='text-muted-foreground'>
                Manage your users and their roles here.
              </p>
            </div>
            <DataTablePrimaryButtons />
          </div>
          <Suspense fallback={<DataTableSkeleton columns={columns} />}>
            <DataTable />
          </Suspense>
        </Main>

        <DataTableDialogs />
      </Page>
    </DataTableProvider>
  )
}
