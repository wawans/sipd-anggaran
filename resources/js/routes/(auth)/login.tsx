import { createFileRoute } from '@tanstack/react-router'
import { z } from 'zod'
import { SignIn } from '@/pages/auth/login'

const searchSchema = z.object({
  redirect: z.string().optional(),
})

export const Route = createFileRoute('/(auth)/login')({
  beforeLoad: async ({ context }) => {
    if (context.auth.isAuthenticated) {
      context.auth.reset()
    }
  },
  component: SignIn,
  validateSearch: searchSchema,
})
