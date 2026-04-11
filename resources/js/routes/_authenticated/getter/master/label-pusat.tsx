import { createFileRoute } from '@tanstack/react-router'
import { columns } from '@/pages/getters/columns/master/label-columns'
import { dataTableQueryOptions } from '@/pages/getters/components/data-table-provider'
import Page from '@/pages/getters/index'

const URL: string = '/api/getter/master/labelPusat'

export const Route = createFileRoute(
  '/_authenticated/getter/master/label-pusat'
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
      entity='Label Pusat'
      columns={columns}
      queryOptions={data.queryOptions}
      url={data.url}
    />
  )
}
