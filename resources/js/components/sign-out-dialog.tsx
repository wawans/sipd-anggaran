import { useMutation } from '@tanstack/react-query'
import { useNavigate, useLocation, useRouter } from '@tanstack/react-router'
import type { AxiosError } from 'axios'
import { toast } from 'sonner'
import { ConfirmDialog } from '@/components/confirm-dialog'
import { Spinner } from '@/components/ui/spinner'
import { useAuth } from '@/context/auth-provider'
import type { LaravelValidationError } from '@/types'

interface SignOutDialogProps {
  open: boolean
  onOpenChange: (open: boolean) => void
}

export function SignOutDialog({ open, onOpenChange }: SignOutDialogProps) {
  const router = useRouter()
  const navigate = useNavigate()
  const location = useLocation()
  const { logout } = useAuth()

  const { mutate, isPending } = useMutation({
    mutationFn: () => logout(),
    onSettled: () => {
      router.invalidate().finally(() => {
        // Preserve current location for redirect after sign-in
        // @ts-expect-error @typescript-eslint/no-unused-vars
        // eslint-disable-next-line @typescript-eslint/no-unused-vars
        const currentPath = location.href
        navigate({
          to: '/login',
          // search: { redirect: currentPath },
          replace: true,
        })
      })
    },
    onError: ({ response }: AxiosError<LaravelValidationError>) => {
      if (response?.status === 422) {
        if (response?.data?.message) {
          toast.error('Error!', {
            description: response?.data?.message || 'Something went wrong.',
          })
        }
      } else {
        toast.error('Error!', {
          description: response?.statusText || 'Something went wrong',
        })
      }
    },
  })

  const handleSignOut = () => {
    mutate()
  }

  return (
    <ConfirmDialog
      open={open}
      onOpenChange={onOpenChange}
      isLoading={isPending}
      title='Sign out'
      desc='Are you sure you want to sign out? You will need to sign in again to access your account.'
      confirmText={isPending ? <Spinner /> : 'Sign out'}
      destructive
      handleConfirm={() => handleSignOut()}
      className='sm:max-w-sm'
    />
  )
}
