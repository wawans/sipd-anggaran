import { createFileRoute } from '@tanstack/react-router'
import { SettingsApiKeys } from '@/pages/settings/api-keys'

export const Route = createFileRoute('/_authenticated/settings/api-keys')({
  component: SettingsApiKeys,
})
