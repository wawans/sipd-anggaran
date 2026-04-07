import { queryOptions } from '@tanstack/react-query'
import React, { useState } from 'react'
import useDialogState from '@/hooks/use-dialog-state'
import axios from '@/lib/api'
import type { User } from '@/types'

type DataTableDialogType = 'invite' | 'add' | 'edit' | 'delete'

type DataTableContextType = {
  open: DataTableDialogType | null
  setOpen: (str: DataTableDialogType | null) => void
  currentRow: User | null
  setCurrentRow: React.Dispatch<React.SetStateAction<User | null>>
}

const DataTableContext = React.createContext<DataTableContextType | null>(null)

export function DataTableProvider({ children }: { children: React.ReactNode }) {
  const [open, setOpen] = useDialogState<DataTableDialogType>(null)
  const [currentRow, setCurrentRow] = useState<User | null>(null)

  return (
    <DataTableContext value={{ open, setOpen, currentRow, setCurrentRow }}>
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

  return context
}

// eslint-disable-next-line react-refresh/only-export-components
export const dataTableQueryOptions = queryOptions({
  queryKey: ['users'],
  queryFn: () => axios.get('/api/user').then((r) => r.data?.data ?? r.data),
})

export type DataTableQueryOptionsType = typeof dataTableQueryOptions
