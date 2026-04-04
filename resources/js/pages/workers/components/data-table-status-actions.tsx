import { useMutation, useQueryClient } from '@tanstack/react-query'
import { useRouter } from '@tanstack/react-router'
import type { Row } from '@tanstack/react-table'

import { toast } from 'sonner'
import { Switch } from '@/components/ui/switch'
import type { Model } from '@/types'

import { useDataTable } from './data-table-provider'

type DataTableRowActionsProps = {
  row: Row<Model>
}

export function DataTableStatusActions({ row }: DataTableRowActionsProps) {
  const { update, queryOptions } = useDataTable()
  const model = row.original

  // @ts-expect-error @typescript-eslint/no-unused-vars
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  const router = useRouter()
  const queryClient = useQueryClient()
  const { mutateAsync } = useMutation({
    mutationFn: (data: any) => update(model.id, data),
    // onMutate: async (data) => {
    //   // Cancel outgoing queries
    //   await queryClient.cancelQueries(queryOptions.queryKey);

    //   // Snapshot current state
    //   const previous = queryClient.getQueryData(queryOptions.queryKey);

    //   // Optimistically update
    //   queryClient.setQueryData(queryOptions.queryKey, (old) =>
    //     old.filter((e) => e.id !== model.id)
    //   );

    //   return { previous };
    // },
    // onError: (err, id, context) => {
    //   // Rollback on error
    //   queryClient.setQueryData(queryOptions.queryKey, context?.previous);
    // },
    onMutate: async () => {
      // Cancel outgoing queries
      await queryClient.cancelQueries(queryOptions.queryKey)

      // Optimistically update
      queryClient.setQueryData(
        queryOptions.queryKey,
        (queryResponse: { data: Model[] }) => {
          // console.log(prevItems)
          const prevItems: Model[] = queryResponse.data

          return {
            ...queryResponse,
            data: prevItems?.map((item: Model) =>
              item.id === model.id
                ? // ? { ...item, { ...model, status_getter: !model.status_getter } }
                  // ? { ...item, ...model }
                  { ...item, status_getter: !item.status_getter }
                : item
            ),
          }
        }
      )
    },
    onSettled: () => {
      queryClient.invalidateQueries({
        queryKey: queryOptions.queryKey,
        // refetchType: 'all',
      })
      // router.invalidate()
    },
  })

  const onChange = () => {
    toast.promise(mutateAsync({ status_getter: !model.status_getter }), {
      loading: 'Updating Status...',
    })
  }

  return (
    <>
      <Switch
        checked={model.status_getter as boolean}
        onCheckedChange={onChange}
      />
    </>
  )
}
