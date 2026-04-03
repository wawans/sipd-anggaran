import { Main } from '@/components/layout/main'
import { Page } from '@/components/layout/page'
// import { Button } from '@/components/ui/button'

export function Dashboard() {
  return (
    <Page>
      <Main>
        <div className='mb-2 flex items-center justify-between space-y-2'>
          <h1 className='text-2xl font-bold tracking-tight'>Dashboard</h1>
          <div className='flex items-center space-x-2'>
            {/* <Button>Download</Button> */}
          </div>
        </div>
      </Main>
    </Page>
  )
}
