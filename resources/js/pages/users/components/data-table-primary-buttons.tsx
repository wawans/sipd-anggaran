import { MailPlus, UserPlus } from 'lucide-react'
import { Button } from '@/components/ui/button'
import { useDataTable } from './data-table-provider'

export function DataTablePrimaryButtons() {
  const { setOpen } = useDataTable()

  return (
    <div className='flex gap-2'>
      <Button
        variant='outline'
        className='space-x-1'
        onClick={() => setOpen('invite')}
      >
        <span>Invite User</span> <MailPlus size={18} />
      </Button>
      <Button className='space-x-1' onClick={() => setOpen('add')}>
        <span>Add User</span> <UserPlus size={18} />
      </Button>
    </div>
  )
}
