import React from 'react'
import { TooltipProvider } from '@/components/ui/tooltip'
import { AuthProvider } from '@/context/auth-provider'

export function Main({ children }: { children?: React.ReactNode }) {
  return (
    <TooltipProvider delayDuration={0}>
      <AuthProvider>{children}</AuthProvider>
    </TooltipProvider>
  )
}
