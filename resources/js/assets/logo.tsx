import type { SVGProps } from 'react'
import { cn } from '@/lib/utils'

export function Logo({ className, ...props }: SVGProps<SVGSVGElement>) {
  return (
    <svg
      xmlns='http://www.w3.org/2000/svg'
      width='32'
      height='48'
      fill='none'
      viewBox='0 0 32 48'
      className={cn('size-6 text-[#15803D] dark:text-primary', className)}
      {...props}
    >
      <path
        fill='currentColor'
        d='M.6 19.2h9.6v9.6H.6zM31.4 28.8h-9.6v-9.6h9.6z'
      ></path>
      <path
        fill='currentColor'
        d='m10.2 19.2 11.6-9.6v9.6l-11.6 9.6z'
        opacity='0.2'
      ></path>
      <path
        fill='currentColor'
        d='m21.799 28.8-11.6 9.6v-9.6l11.6-9.6z'
        opacity='0.5'
      ></path>
      <path
        fill='currentColor'
        d='M.6 19.2 21.8 0v9.6l-11.6 9.6z'
        opacity='0.6'
      ></path>
      <path
        fill='currentColor'
        d='M31.4 28.8 10.2 48v-9.6l11.6-9.6z'
        opacity='0.7'
      ></path>
    </svg>
  )
}
