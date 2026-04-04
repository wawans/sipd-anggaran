import { Main } from '@/components/layout/main'
import { Page } from '@/components/layout/page'

export function About() {
  return (
    <Page>
      <Main className='flex flex-1 flex-col gap-4 sm:gap-6 lg:gap-8'>
        <section className='island-shell rounded-2xl p-6 sm:p-8'>
          <p className='island-kicker mb-2'>About</p>
          <h1 className='display-title mb-3 text-4xl font-bold text-[var(--sea-ink)] sm:text-5xl'>
            A small starter with room to grow.
          </h1>
          <p className='m-0 max-w-3xl text-base leading-8 text-[var(--sea-ink-soft)]'>
            TanStack Start gives you type-safe routing, server functions, and
            modern SSR defaults. Use this as a clean foundation, then layer in
            your own routes, styling, and add-ons.
          </p>
        </section>
      </Main>
    </Page>
  )
}
