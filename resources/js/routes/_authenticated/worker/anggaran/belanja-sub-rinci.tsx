import { createFileRoute } from '@tanstack/react-router'
import z from 'zod'
import { allQueryOptions } from '@/pages/workers/components/api'
import Page from '@/pages/workers/index'

const searchSchema = z.object({
  page: z.number().optional().catch(1),
  pageSize: z.number().optional().catch(10),
})


export const Route = createFileRoute(
  '/_authenticated/worker/anggaran/belanja-sub-rinci',
)({
  component: Page,
  loader: ({ context: { queryClient } }) =>
    queryClient.ensureQueryData(allQueryOptions),
  validateSearch: searchSchema,
})

