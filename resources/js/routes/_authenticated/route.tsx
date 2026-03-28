import { createFileRoute, redirect, isRedirect } from '@tanstack/react-router'
import { AuthenticatedLayout } from '@/components/layout/authenticated-layout'

export const Route = createFileRoute('/_authenticated')({
  beforeLoad: async ({ context, location }) => {
    if (!context.auth.isAuthenticated) {
      try {
        const user = await context.auth.getUser()

        if (!user) {
          throw redirect({
            to: '/login',
            search: {
              redirect: location.href,
            },
          })
        }
      } catch (error) {
        if (isRedirect(error)) {
          throw error
        }

        throw redirect({
          to: '/login',
          search: {
            redirect: location.href,
          },
        })
      }
    }
  },

  component: AuthenticatedLayout,
})
