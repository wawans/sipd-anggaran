import type { Row } from '@tanstack/react-table'

import { useState } from 'react'
import { Switch } from '@/components/ui/switch'
import type { Model } from '@/types'

import { useDataTable } from './data-table-provider'

type DataTableRowActionsProps = {
  row: Row<Model>
}

export function DataTableStatusActions({ row }: DataTableRowActionsProps) {
  const { setOpen, setCurrentRow } = useDataTable()
  const model = row.original

  const [value, setValue] = useState<boolean>(model.status_getter || false)

  const onChange = () => {
    setValue((prevState) => !prevState)
  }

  return (
    <>
      <Switch checked={value} onCheckedChange={onChange} />
    </>
  )
}
