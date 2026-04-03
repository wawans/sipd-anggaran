import { Logo } from '@/assets/logo'
import { APP_TITLE, APP_SUBTITLE } from '@/config/app'

type AuthLayoutProps = {
  children: React.ReactNode
}

export function AuthLayout({ children }: AuthLayoutProps) {
  return (
    <div className='container grid h-svh max-w-none items-center justify-center'>
      <div className='mx-auto flex w-full flex-col justify-center space-y-2 py-8 sm:w-[480px] sm:p-8'>
        <div className='mb-6 flex items-center justify-center'>
          <div className='flex items-center justify-center'>
            <Logo className='me-2 size-10' />
            <div className='grid flex-1 text-start text-sm leading-tight'>
              <h1 className='text-xl font-bold'>{APP_TITLE}</h1>
              <h5 className='truncate text-xs'>{APP_SUBTITLE}</h5>
            </div>
          </div>
        </div>
        {children}
      </div>
    </div>
  )
}
