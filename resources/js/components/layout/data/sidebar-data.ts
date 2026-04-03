import {
  LayoutDashboard,
  Monitor,
  ListTodo,
  HelpCircle,
  Bell,
  Palette,
  Settings,
  Wrench,
  UserCog,
  Users,
  AudioWaveform,
  Command,
  GalleryVerticalEnd,
  Database,
} from 'lucide-react'
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
      ],
    },
    {
      title: 'Database',
      items: [
        {
          title: 'Penganggaran',
          icon: Database,
          items: [
            {
              title: 'Get SKPD',
              url: '/getter/anggaran/skpd',
            },
            {
              title: 'Get Sub Giat',
              url: '/getter/anggaran/belanja-sub',
            },
            {
              title: 'Get Rinci Sub Giat',
              items: [
                {
                  title: 'Sub Rinci',
                  url: '/getter/anggaran/belanja-sub-rinci',
                },
                {
                  title: 'Sub Sub',
                  url: '/getter/anggaran/belanja-sub-sub',
                },
                {
                  title: 'Sub Ket',
                  url: '/getter/anggaran/belanja-sub-ket',
                },
                {
                  title: 'Sub Dana',
                  url: '/getter/anggaran/belanja-sub-dana',
                },
              ],
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
              title: 'Get Sub Giat',
              url: '/worker/anggaran/belanja-sub',
            },
            {
              title: 'Get Rinci Sub Giat',
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
