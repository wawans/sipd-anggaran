import { createFileRoute } from '@tanstack/react-router'
import { z } from 'zod'
import { SignIn } from '@/pages/auth/login'

const searchSchema = z.object({
  redirect: z.string().optional(),
})

export const Route = createFileRoute('/(auth)/login')({
  component: SignIn,
  validateSearch: searchSchema,
})
