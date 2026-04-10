import { createFileRoute } from '@tanstack/react-router'
import { columns } from '@/pages/getters/columns/anggaran-belanja-sub-label-columns'
import { dataTableQueryOptions } from '@/pages/getters/components/data-table-provider'
import Page from '@/pages/getters/index'

const URL: string = '/api/getter/anggaran/belanja/sub/label'

export const Route = createFileRoute(
  '/_authenticated/getter/anggaran/belanja-sub-label'
)({
  component: RouteComponent,
  loader: ({ context: { queryClient } }) => {
    queryClient.prefetchQuery(dataTableQueryOptions(URL))

    return {
      url: URL,
      queryOptions: dataTableQueryOptions(URL),
    }
  },
})

// eslint-disable-next-line react-refresh/only-export-components
function RouteComponent() {
  const data = Route.useLoaderData()

  return (
    <Page
      entity='Rinci Sub Giat - Sub Label'
      columns={columns}
      queryOptions={data.queryOptions}
      url={data.url}
    />
  )
}
