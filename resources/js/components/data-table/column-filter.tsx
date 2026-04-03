import type { Column } from '@tanstack/react-table'
import { useState, useDeferredValue, useEffect } from 'react'
import { Input } from '@/components/ui/input'

export function ColumnFilter({ column }: { column: Column<any, unknown> }) {
  const [value, setValue] = useState<any>(column.getFilterValue() as any)
  const deferredValue = useDeferredValue(value)

  const { filterColumn } = column.columnDef.meta ?? {}

  useEffect(() => {
    column.setFilterValue(deferredValue)
  }, [deferredValue])

  return (
    <Input
      type='text'
      value={(value ?? '') as string}
      onChange={(event) => setValue(event.target.value)}
      className='h-8'
      placeholder='Search...'
    />
  )
}
