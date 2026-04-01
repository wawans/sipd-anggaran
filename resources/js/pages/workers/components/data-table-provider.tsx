import React, { useCallback, useState } from 'react'
import useDialogState from '@/hooks/use-dialog-state'
import axios from '@/lib/api'
import type { Model } from '@/types'

type DataTableDialogType =
  | 'create'
  | 'update'
  | 'delete'
  | 'import'
  | 'export'
  | 'download'

type DataTableContextType = {
  entity: string
  url: string
  queryOptions: any
  open: DataTableDialogType | null
  setOpen: (str: DataTableDialogType | null) => void
  currentRow: Model | null
  setCurrentRow: React.Dispatch<React.SetStateAction<Model | null>>
}

const DataTableContext = React.createContext<DataTableContextType | null>(null)

type DataTableProviderType = Pick<
  DataTableContextType,
  'entity' | 'url' | 'queryOptions'
> & {
  children: React.ReactNode
}
export function DataTableProvider({
  entity,
  url,
  queryOptions,
  children,
}: DataTableProviderType) {
  const [open, setOpen] = useDialogState<DataTableDialogType>(null)
  const [currentRow, setCurrentRow] = useState<Model | null>(null)

  return (
    <DataTableContext
      value={{
        entity,
        url,
        queryOptions,
        open,
        setOpen,
        currentRow,
        setCurrentRow,
      }}
    >
      {children}
    </DataTableContext>
  )
}

// eslint-disable-next-line react-refresh/only-export-components
export const useDataTable = () => {
  const context = React.useContext(DataTableContext)

  if (!context) {
    throw new Error('useDataTable has to be used within <DataTableContext>')
  }

  const fetchAll = useCallback(async () => {
    return axios.get(context.url).then((r) => r.data)
  }, [context.url])
  const show = useCallback(
    async (id: number | string) => {
      return axios.get(context.url + '/' + id).then((r) => r.data)
    },
    [context.url]
  )
  const create = useCallback(
    async (data: any) => {
      return axios.post(context.url, data).then((r) => r.data)
    },
    [context.url]
  )
  const update = useCallback(
    async (id: number | string, data: any) => {
      return axios.put(context.url + '/' + id, data).then((r) => r.data)
    },
    [context.url]
  )
  const destroy = useCallback(
    async (id: number | string) => {
      return axios.delete(context.url + '/' + id).then((r) => r.data)
    },
    [context.url]
  )
  const destroys = useCallback(
    async (data: any) => {
      return axios.post(context.url + '/destroys', data).then((r) => r.data)
    },
    [context.url]
  )

  return {
    ...context,
    fetchAll,
    show,
    create,
    update,
    destroy,
    destroys,
  }
}
