import { createFileRoute } from '@tanstack/react-router'
import { dataTableQueryOptions } from '@/pages/users/components/data-table-provider'
import Page from '@/pages/users/index'

export const Route = createFileRoute('/_authenticated/users/')({
  component: Page,
  loader: ({ context: { queryClient } }) =>
    queryClient.prefetchQuery(dataTableQueryOptions),
})
