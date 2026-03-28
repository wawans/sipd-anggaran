import type { KnipConfig } from 'knip'

const config: KnipConfig = {
  entry: ['resources/js/app.tsx'],
  project: ['resources/**/*.{ts,tsx}'],
  ignore: [
    'resources/js/components/ui/**',
    'resources/js/components/layout/app-title.tsx',
    'resources/js/components/layout/team-switcher.tsx',
    'resources/js/types/*.d.ts',
    'resources/js/routeTree.gen.ts',
    '*.bak',
  ],
}

export default config
