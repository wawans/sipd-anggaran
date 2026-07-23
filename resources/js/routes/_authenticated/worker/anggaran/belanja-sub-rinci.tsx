import { queryOptions } from '@tanstack/react-query'
import { createFileRoute } from '@tanstack/react-router'
import z from 'zod'
import axios from '@/lib/api'
import { columns } from '@/pages/workers/columns/anggaran-belanja-sub-rinci-columns'
import Page from '@/pages/workers/index'

const searchSchema = z.object({
  page: z.number().optional().catch(1),
  pageSize: z.number().optional().catch(10),
})

const URL: string = '/api/anggaran/belanja/sub'

const allQueryOptions = queryOptions({
  queryKey: ['workers', { url: URL }],
  queryFn: () => axios.get(URL).then((r) => r.data),
})

export const Route = createFileRoute(
  '/_authenticated/worker/anggaran/belanja-sub-rinci'
)({
  component: RouteComponent,
  loader: ({ context: { queryClient } }) => {
    queryClient.prefetchQuery(allQueryOptions)

    return {
      url: URL,
      queryOptions: allQueryOptions,
    }
  },
  validateSearch: searchSchema,
})

// eslint-disable-next-line react-refresh/only-export-components
function RouteComponent() {
  const data = Route.useLoaderData()

  return (
    <Page
      url={URL}
      entity='Get Rinci Sub Kegiatan'
      columns={columns}
      queryOptions={data.queryOptions}
    />
  )
}
