import { useSuspenseQuery } from '@tanstack/react-query'
// import { getRouteApi } from '@tanstack/react-router'
import { Main } from '@/components/layout/main'
import { Page } from '@/components/layout/page'

import { allQueryOptions } from './components/api'
import { DataTable } from './components/data-table'
import { DataTableDialogs } from './components/data-table-dialogs'
import { DataTablePrimaryButtons } from './components/data-table-primary-buttons'
import { DataTableProvider } from './components/data-table-provider'

// const route = getRouteApi('/_authenticated/(ref)/ref-usaha/')

export default function IndexPage() {

  // const search = route.useSearch()
  // const navigate = route.useNavigate()

  const { data: query } = useSuspenseQuery(allQueryOptions)
  const rows = query.data

  const entityName = 'Get Rinci Sub Kegiatan'

  return (
    <DataTableProvider entity={entityName}>
      <Page>
        <Main className='flex flex-1 flex-col gap-4 sm:gap-6'>
          <div className='flex flex-wrap items-end justify-between gap-2'>
            <div>
              <h2 className='text-2xl font-bold tracking-tight'>
                {entityName}
              </h2>
              <p className='text-muted-foreground'>
                Manage your {entityName} and their information here.
              </p>
            </div>
            <DataTablePrimaryButtons />
          </div>
          <DataTable data={rows} />
        </Main>

        <DataTableDialogs />
      </Page>
    </DataTableProvider>
  )
}
