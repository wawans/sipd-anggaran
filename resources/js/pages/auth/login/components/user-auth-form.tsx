import { zodResolver } from '@hookform/resolvers/zod'
import { GitHubLogoIcon, TwitterLogoIcon } from '@radix-ui/react-icons'
import { Link, useNavigate, useRouter } from '@tanstack/react-router'
import { AxiosError } from 'axios'
import { Loader2, LogIn } from 'lucide-react'
import { useState } from 'react'
import { useForm } from 'react-hook-form'
import { toast } from 'sonner'
import { z } from 'zod'
import { PasswordInput } from '@/components/password-input'
import { Button } from '@/components/ui/button'
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { useAuth } from '@/context/auth-provider'
import { cn } from '@/lib/utils'
import type { LaravelValidationError } from '@/types'

const formSchema = z.object({
  email: z.email({
    error: (iss) => (iss.input === '' ? 'Please enter your email' : undefined),
  }),
  password: z
    .string()
    .min(1, 'Please enter your password')
    .min(7, 'Password must be at least 7 characters long'),
})

interface UserAuthFormProps extends React.HTMLAttributes<HTMLFormElement> {
  redirectTo?: string
}

export function UserAuthForm({
  className,
  redirectTo,
  ...props
}: UserAuthFormProps) {
  const [isLoading, setIsLoading] = useState(false)
  const navigate = useNavigate()
  const router = useRouter()
  const { login } = useAuth()

  const form = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      email: '',
      password: '',
    },
  })

  function onSubmit(data: z.infer<typeof formSchema>) {
    setIsLoading(true)

    toast.promise(login(data.email, data.password), {
      loading: 'Signing in...',
      success: (response) => {
        if (!response.data) {
          throw new AxiosError('Login Failed')
        }

        router.invalidate()

        // Redirect to the stored location or default to dashboard
        const targetPath = redirectTo || '/'
        navigate({ to: targetPath, replace: true })

        return `Welcome back, ${response.data.name || data.email}!`
      },
      error: ({ response }: AxiosError<LaravelValidationError>) => {
        if (response?.status === 422) {
          if (response?.data?.errors) {
            for (const [key, value] of Object.entries(response.data.errors)) {
              form.setError(key as keyof z.infer<typeof formSchema>, {
                type: 'server',
                message: value[0] || 'Invalid',
              })
            }
          }

          if (response?.data?.message) {
            return (
              'Error! ' + response?.data?.message || 'Something went wrong.'
            )
          }
        } else {
          return 'Login Failed! Something went wrong.'
        }
      },
      finally: () => setIsLoading(false),
    })
  }

  return (
    <Form {...form}>
      <form
        onSubmit={form.handleSubmit(onSubmit)}
        className={cn('grid gap-3', className)}
        {...props}
      >
        <FormField
          control={form.control}
          name='email'
          render={({ field }) => (
            <FormItem>
              <FormLabel>Email</FormLabel>
              <FormControl>
                <Input placeholder='name@example.com' {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
        <FormField
          control={form.control}
          name='password'
          render={({ field }) => (
            <FormItem className='relative'>
              <FormLabel>Password</FormLabel>
              <FormControl>
                <PasswordInput placeholder='********' {...field} />
              </FormControl>
              <FormMessage />
              <Link
                to='/forgot-password'
                className='absolute end-0 -top-0.5 text-sm font-medium text-muted-foreground hover:opacity-75'
              >
                Forgot password?
              </Link>
            </FormItem>
          )}
        />
        <Button className='mt-2' disabled={isLoading}>
          {isLoading ? <Loader2 className='animate-spin' /> : <LogIn />}
          Sign in
        </Button>

        <div className='relative my-2'>
          <p className='px-8 text-center text-sm text-muted-foreground'>
            Don't have an account?{' '}
            <Link
              to='/register'
              className='underline underline-offset-4 hover:text-primary'
            >
              Sign up
            </Link>
          </p>
        </div>

        <div className='relative my-2'>
          <div className='absolute inset-0 flex items-center'>
            <span className='w-full border-t' />
          </div>
          <div className='relative flex justify-center text-xs uppercase'>
            <span className='bg-background px-2 text-muted-foreground'>
              Or continue with
            </span>
          </div>
        </div>

        <div className='grid grid-cols-2 gap-2'>
          <Button variant='outline' type='button' disabled={isLoading}>
            <GitHubLogoIcon className='h-4 w-4' /> GitHub
          </Button>
          <Button variant='outline' type='button' disabled={isLoading}>
            <TwitterLogoIcon className='h-4 w-4' /> Twitter
          </Button>
        </div>
      </form>
    </Form>
  )
}
