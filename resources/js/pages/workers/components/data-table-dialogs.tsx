import { DataActionDialog } from './data-action-dialog'
import { DatasDeleteDialog } from './data-delete-dialog'

import { useDataTable } from './data-table-provider'

export function DataTableDialogs() {
  const { open, setOpen, currentRow, setCurrentRow } = useDataTable()

  return (
    <>
      <DataActionDialog
        key='data-create'
        open={open === 'create'}
        onOpenChange={() => setOpen('create')}
      />



      {currentRow && (
        <>
          <DataActionDialog
            key={`data-update-${currentRow.id}`}
            open={open === 'update'}
            onOpenChange={() => {
              setOpen('update')
              setTimeout(() => {
                setCurrentRow(null)
              }, 500)
            }}
            currentRow={currentRow}
          />

          <DatasDeleteDialog
            key={`data-delete-${currentRow.id}`}
            open={open === 'delete'}
            onOpenChange={() => {
              setOpen('delete')
              setTimeout(() => {
                setCurrentRow(null)
              }, 500)
            }}
            currentRow={currentRow}
          />
        </>
      )}
    </>
  )
}
