import {
  ChevronDownIcon,
  Download,
  ExternalLink,
  FileSpreadsheet,
  Plus,
} from 'lucide-react'
import { Button } from '@/components/ui/button'
import { ButtonGroup } from '@/components/ui/button-group.tsx'
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuGroup,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu.tsx'

import { useDataTable } from './data-table-provider'

export function DataTablePrimaryButtons() {
  const { setOpen } = useDataTable()

  return (
    <div className='flex gap-2'>

        <Button
          variant='outline'
          className='space-x-1'
          onClick={() => setOpen('import')}
        >
          <span>Import</span> <Download size={18} />
        </Button>



      <Button className='space-x-1' onClick={() => setOpen('create')}>
        <span>Create</span> <Plus size={18} />
      </Button>
    </div>
  )
}
