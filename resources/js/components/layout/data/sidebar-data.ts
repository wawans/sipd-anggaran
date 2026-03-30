import {
  Construction,
  LayoutDashboard,
  Monitor,
  Bug,
  ListTodo,
  FileX,
  HelpCircle,
  Lock,
  Bell,
  Package,
  Palette,
  ServerOff,
  Settings,
  Wrench,
  UserCog,
  UserX,
  Users,
  MessagesSquare,
  ShieldCheck,
  AudioWaveform,
  Command,
  GalleryVerticalEnd,
} from 'lucide-react'
import { Logo as ClerkLogo } from '@/assets/logo'
import type { SidebarData } from '../types'

export const sidebarData: SidebarData = {
  user: {
    name: 'satnaing',
    email: 'satnaingdev@gmail.com',
    avatar: '/avatars/shadcn.jpg',
  },
  teams: [
    {
      name: 'Shadcn Admin',
      logo: Command,
      plan: 'Vite + ShadcnUI',
    },
    {
      name: 'Acme Inc',
      logo: GalleryVerticalEnd,
      plan: 'Enterprise',
    },
    {
      name: 'Acme Corp.',
      logo: AudioWaveform,
      plan: 'Startup',
    },
  ],
  navGroups: [
    {
      title: 'General',
      items: [
        {
          title: 'Dashboard',
          url: '/',
          icon: LayoutDashboard,
        },
        {
          title: 'Users',
          url: '/users',
          icon: Users,
        },
        {
          title: 'Penganggaran',
          icon: ListTodo,
          items: [
            {
              title: 'Get SKPD',
              url: '/anggaran/skpd',
            },
            {
              title: 'Get Sub Kegiatan',
              url: '/anggaran/belanja-sub',
            },
            {
              title: 'Get Rinci Sub Kegiatan',
              url: '/anggaran/belanja-sub-rinci',
            },
          ],
        },
      ],
    },
    {
      title: 'Worker',
      items: [
        {
          title: 'Penganggaran',
          icon: ListTodo,
          items: [
            {
              title: 'Get SKPD',
              url: '/worker/anggaran/skpd',
            },
            {
              title: 'Get Sub Kegiatan',
              url: '/worker/anggaran/belanja-sub',
            },
            {
              title: 'Get Rinci Sub Kegiatan',
              url: '/worker/anggaran/belanja-sub-rinci',
            },
          ],
        },
      ],
    },
    {
      title: 'Other',
      items: [
        {
          title: 'Settings',
          icon: Settings,
          items: [
            {
              title: 'Profile',
              url: '/settings',
              icon: UserCog,
            },
            {
              title: 'Account',
              url: '/settings/account',
              icon: Wrench,
            },
            {
              title: 'Appearance',
              url: '/settings/appearance',
              icon: Palette,
            },
            {
              title: 'Notifications',
              url: '/settings/notifications',
              icon: Bell,
            },
            {
              title: 'Display',
              url: '/settings/display',
              icon: Monitor,
            },
          ],
        },
        {
          title: 'Help Center',
          url: '/help-center',
          icon: HelpCircle,
        },
      ],
    },
  ],
}
