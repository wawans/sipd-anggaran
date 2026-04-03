import { zodResolver } from '@hookform/resolvers/zod'
import { GitHubLogoIcon, TwitterLogoIcon } from '@radix-ui/react-icons'
import { useNavigate, useRouter } from '@tanstack/react-router'
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

const formSchema = z
  .object({
    name: z
      .string()
      .min(1, 'Required')
      .min(4, 'Must be at least 4 characters long'),
    email: z.email({
      error: (iss) =>
        iss.input === '' ? 'Please enter your email' : undefined,
    }),
    password: z
      .string()
      .min(1, 'Please enter your password')
      .min(7, 'Password must be at least 7 characters long'),
    confirmPassword: z.string().min(1, 'Please confirm your password'),
  })
  .refine((data) => data.password === data.confirmPassword, {
    message: "Passwords don't match.",
    path: ['confirmPassword'],
  })

export function SignUpForm({
  className,
  ...props
}: React.HTMLAttributes<HTMLFormElement>) {
  const [isLoading, setIsLoading] = useState(false)
  const navigate = useNavigate()
  const router = useRouter()
  const { register } = useAuth()

  const form = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      name: '',
      email: '',
      password: '',
      confirmPassword: '',
    },
  })

  function onSubmit(data: z.infer<typeof formSchema>) {
    setIsLoading(true)
    form.clearErrors()

    // Use the auth context register method which handles session-based auth
    register(data.name, data.email, data.password, data.confirmPassword)
      .then((response) => {
        if (!response.data) {
          throw new AxiosError('Sign Up Failed')
        }

        router.invalidate()

        // Success - navigate to dashboard
        navigate({ to: '/', replace: true })
      })
      .catch(({ response }: AxiosError<LaravelValidationError>) => {
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
            toast.error('Error!', {
              description: response?.data?.message || 'Something went wrong.',
            })
          }
        } else {
          toast.error('Error!', { description: 'Something went wrong' })
        }
      })
      .finally(() => {
        setIsLoading(false)
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
          name='name'
          render={({ field }) => (
            <FormItem>
              <FormLabel>Name</FormLabel>
              <FormControl>
                <Input {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
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
            <FormItem>
              <FormLabel>Password</FormLabel>
              <FormControl>
                <PasswordInput placeholder='********' {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
        <FormField
          control={form.control}
          name='confirmPassword'
          render={({ field }) => (
            <FormItem>
              <FormLabel>Confirm Password</FormLabel>
              <FormControl>
                <PasswordInput placeholder='********' {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
        <Button className='mt-2' disabled={isLoading}>
          {isLoading ? <Loader2 className='animate-spin' /> : <LogIn />}
          Create Account
        </Button>

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
          <Button
            variant='outline'
            className='w-full'
            type='button'
            disabled={isLoading}
          >
            <GitHubLogoIcon className='h-4 w-4' /> GitHub
          </Button>
          <Button
            variant='outline'
            className='w-full'
            type='button'
            disabled={isLoading}
          >
            <TwitterLogoIcon className='h-4 w-4' /> Twitter
          </Button>
        </div>
      </form>
    </Form>
  )
}
