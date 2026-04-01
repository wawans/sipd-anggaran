import React, { useState } from 'react'
import type { Model } from '@/types'
import useDialogState from '@/hooks/use-dialog-state'

type DataTableDialogType =
  | 'create'
  | 'update'
  | 'delete'
  | 'import'
  | 'export'
  | 'download'

type DataTableContextType = {
  entity: string
  open: DataTableDialogType | null
  setOpen: (str: DataTableDialogType | null) => void
  currentRow: Model | null
  setCurrentRow: React.Dispatch<React.SetStateAction<Model | null>>
}

const DataTableContext = React.createContext<DataTableContextType | null>(null)

export function DataTableProvider({
  entity,
  children,
}: {
  entity: string
  children: React.ReactNode
}) {
  const [open, setOpen] = useDialogState<DataTableDialogType>(null)
  const [currentRow, setCurrentRow] = useState<Model | null>(null)

  return (
    <DataTableContext
      value={{ entity, open, setOpen, currentRow, setCurrentRow }}
    >
      {children}
    </DataTableContext>
  )
}

// eslint-disable-next-line react-refresh/only-export-components
export const useDataTable = () => {
  const usersContext = React.useContext(DataTableContext)

  if (!usersContext) {
    throw new Error('useDataTable has to be used within <DataTableContext>')
  }

  return usersContext
}
