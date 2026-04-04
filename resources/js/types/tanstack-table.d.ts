import '@tanstack/react-table'

import type { RowData } from '@tanstack/react-table'

declare module '@tanstack/react-table' {
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  interface ColumnMeta<TData, TValue> {
    className?: string // apply to both th and td
    tdClassName?: string
    thClassName?: string
    label?: string
    filterColumn?: string
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  interface ColumnDefBase<TData extends RowData, TValue = unknown> {
    label?: string
    filterColumn?: string
  }
}
