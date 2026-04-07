import { DataTableActionDialog } from './data-table-action-dialog'
import { DataTableDeleteDialog } from './data-table-delete-dialog'
import { DataTableInviteDialog } from './data-table-invite-dialog'
import { useDataTable } from './data-table-provider'

export function DataTableDialogs() {
  const { open, setOpen, currentRow, setCurrentRow } = useDataTable()

  return (
    <>
      <DataTableActionDialog
        key='user-add'
        open={open === 'add'}
        onOpenChange={() => setOpen('add')}
      />

      <DataTableInviteDialog
        key='user-invite'
        open={open === 'invite'}
        onOpenChange={() => setOpen('invite')}
      />

      {currentRow && (
        <>
          <DataTableActionDialog
            key={`user-edit-${currentRow.id}`}
            open={open === 'edit'}
            onOpenChange={() => {
              setOpen('edit')
              setTimeout(() => {
                setCurrentRow(null)
              }, 500)
            }}
            currentRow={currentRow}
          />

          <DataTableDeleteDialog
            key={`user-delete-${currentRow.id}`}
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
