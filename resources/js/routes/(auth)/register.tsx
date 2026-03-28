import { createFileRoute } from '@tanstack/react-router'
import { SignUp } from '@/pages/auth/register'

export const Route = createFileRoute('/(auth)/register')({
  component: SignUp,
})
