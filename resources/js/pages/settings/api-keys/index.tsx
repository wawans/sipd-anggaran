import { ContentSection } from '../components/content-section'
import { ApiKeysForm } from './api-keys-form'
import { ApiKeysTable } from './api-keys-table'

export function SettingsApiKeys() {
  return (
    <ContentSection title='API Keys' desc='Create and manage your api keys.'>
      <>
        <ApiKeysForm />
        <ApiKeysTable />
      </>
    </ContentSection>
  )
}
