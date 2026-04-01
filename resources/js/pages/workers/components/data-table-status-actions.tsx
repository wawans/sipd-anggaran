import { DotsHorizontalIcon } from '@radix-ui/react-icons'
import type { Row } from '@tanstack/react-table'
import type { Model } from '@/types'
import { Trash2, UserPen } from 'lucide-react'
import { Button } from '@/components/ui/button'
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuSeparator,
  DropdownMenuShortcut,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import { Switch } from '@/components/ui/switch'

import { useDataTable } from './data-table-provider'
import { useState } from 'react'

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
      <Switch
        checked={value}
        onCheckedChange={onChange}
      />
    </>
  )
}
