import axios from 'axios'
import { FileSpreadsheet } from 'lucide-react'
import { useCallback } from 'react'
import { toast } from 'sonner'
import { Button } from '@/components/ui/button'

import { useDataTable } from './data-table-provider'

export function DataTablePrimaryButtons() {
  const { url } = useDataTable()

  const onExport = useCallback(() => {
    toast.promise(
      () =>
        axios.get(url + '/export', {
          responseType: 'blob',
        }),
      {
        loading: 'Exporting...',
        success: (response) => {
          try {
            // const blob = new Blob([response.data], {type: response.data.type});
            // const url = window.URL.createObjectURL(blob);
            const url = window.URL.createObjectURL(response.data)
            const link = document.createElement('a')
            link.href = url
            const contentDisposition = response.headers['content-disposition']
            let fileName = 'file'

            if (contentDisposition) {
              const fileNameMatch = contentDisposition.match(/filename="(.+)"/)

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
        },
      }
    )
  }, [url])

  return (
    <div className='flex gap-2'>
      <Button
        variant='outline'
        className='space-x-1'
        onClick={() => onExport()}
      >
        <span>Export</span> <FileSpreadsheet size={18} />
      </Button>
    </div>
  )
}
