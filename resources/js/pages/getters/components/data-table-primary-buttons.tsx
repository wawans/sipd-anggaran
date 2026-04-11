'use client'

import { useMutation, useQueryClient } from '@tanstack/react-query'
import { useRouter } from '@tanstack/react-router'
import type { AxiosError } from 'axios'
import { FileSpreadsheet, Trash, AlertTriangle } from 'lucide-react'
import { useCallback, useState } from 'react'
import { toast } from 'sonner'
import { ConfirmDialog } from '@/components/confirm-dialog'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Button } from '@/components/ui/button'
import { Spinner } from '@/components/ui/spinner'
import axios from '@/lib/api'
import { useDataTable } from './data-table-provider'

export function DataTablePrimaryButtons() {
  const { queryOptions, url } = useDataTable()
  const [open, setOpen] = useState<boolean>(false)

  // @ts-expect-error @typescript-eslint/no-unused-vars
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  const router = useRouter()
  const queryClient = useQueryClient()
  const { mutateAsync, isPending } = useMutation({
    mutationFn: (url: string) => axios.get(url + '/truncate'),
    onMutate: async () => {
      // Cancel outgoing queries
      await queryClient.cancelQueries(queryOptions.queryKey)

      // Optimistically update
      queryClient.setQueryData(
        queryOptions.queryKey,
        (queryResponse: { data: any[] }) => {
          return {
            ...queryResponse,
            data: [],
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

  const onExport = useCallback(() => {
    toast.promise(
      () =>
        axios
          .get(url + '/export', {
            responseType: 'blob',
          })
          .then((response) => {
            try {
              // const blob = new Blob([response.data], {type: response.data.type});
              // const url = window.URL.createObjectURL(blob);
              const url = window.URL.createObjectURL(response.data)
              const link = document.createElement('a')
              link.href = url
              const contentDisposition = response.headers['content-disposition']
              let fileName = 'file'

              if (contentDisposition) {
                const fileNameMatch =
                  contentDisposition.match(/filename="(.+)"/)

                if (fileNameMatch.length === 2) {
                  fileName = fileNameMatch[1]
                }
              }

              link.setAttribute('download', fileName)
              document.body.appendChild(link)
              link.click()
              link.remove()
              window.URL.revokeObjectURL(url)
              // eslint-disable-next-line @typescript-eslint/no-unused-vars
            } catch (e) { /* empty */ }

            return 'OK'
          }),
      {
        loading: 'Exporting...',
        error: ({ response }: AxiosError<any>) =>
          'Error! ' +
            ((response as { message?: string })?.message ||
              response?.statusText) || 'Something went wrong.',
      }
    )
  }, [url])

  const onTruncate = () => {
    toast.promise(
      mutateAsync(url).then(() => {
        setOpen(false)
      }),
      {
        loading: 'Truncating...',
        error: ({ response }: AxiosError<any>) =>
          'Error! ' +
            ((response as { message?: string })?.message ||
              response?.statusText) || 'Something went wrong.',
      }
    )
  }

  return (
    <div className='flex gap-2'>
      <Button
        variant='outline'
        className='space-x-1'
        onClick={() => onExport()}
      >
        <span>Export</span> <FileSpreadsheet size={18} />
      </Button>

      <Button
        variant='destructive'
        className='space-x-1'
        onClick={() => {
          setOpen(true)
        }}
      >
        <span>Truncate</span> <Trash size={18} />
      </Button>

      <ConfirmDialog
        open={open}
        onOpenChange={() => {
          setOpen(false)
        }}
        handleConfirm={onTruncate}
        disabled={isPending}
        isLoading={isPending}
        title={
          <span className='text-destructive'>
            <AlertTriangle
              className='me-1 mb-1 inline-block stroke-destructive'
              size={18}
            />{' '}
            Truncate this table ?
          </span>
        }
        desc={
          <div className='space-y-4'>
            <p className='mb-2'>
              Are you sure you want to truncate this table ?
              <br />
              This action will permanently remove the data from the system.
            </p>

            <Alert variant='destructive'>
              <AlertTitle>Warning!</AlertTitle>
              <AlertDescription>
                Please be careful, this operation can not be rolled back.
              </AlertDescription>
            </Alert>
          </div>
        }
        confirmText={isPending ? <Spinner /> : 'Truncate'}
        destructive
      />
    </div>
  )
}
