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
  KeyRound,
  ShoppingCart,
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
          title: 'Referensi',
          icon: Database,
          items: [
            {
              title: 'Urusan',
              url: '/master/urusan',
            },
            {
              title: 'Bidang Urusan',
              url: '/master/urusan-bidang',
            },
            {
              title: 'Program',
              url: '/master/program',
            },
            {
              title: 'Kegiatan',
              url: '/master/giat',
            },
            {
              title: 'Sub Kegiatan',
              url: '/master/giat-sub',
            },
            {
              title: 'Akun',
              url: '/master/akun',
            },
            {
              title: 'Sumber Dana',
              url: '/master/dana',
            },
            {
              title: 'SKPD',
              url: '/master/skpd',
            },
            {
              title: 'Label',
              items: [
                {
                  title: 'Label Pusat',
                  url: '/master/label-pusat',
                },
                {
                  title: 'Label Provinsi',
                  url: '/master/label-prov',
                },
                {
                  title: 'Label Kota/Kab',
                  url: '/master/label-kokab',
                },
              ],
            },
            {
              title: 'Jadwal',
              url: '/master/jadwal',
            },
            {
              title: 'Tahapan',
              url: '/master/tahap',
            },
          ],
        },
        {
          title: 'Penganggaran',
          icon: ShoppingCart,
          items: [
            {
              title: 'SKPD',
              url: '/anggaran/skpd',
            },
            {
              title: 'Sub Kegiatan',
              url: '/anggaran/belanja-sub',
            },
            {
              title: 'Rinci Sub Kegiatan',
              items: [
                {
                  title: 'Sub Rinci',
                  url: '/anggaran/belanja-sub-rinci',
                },
                {
                  title: 'Sub Sub',
                  url: '/anggaran/belanja-sub-sub',
                },
                {
                  title: 'Sub Ket',
                  url: '/anggaran/belanja-sub-ket',
                },
                {
                  title: 'Sub Dana',
                  url: '/anggaran/belanja-sub-dana',
                },
                {
                  title: 'Sub Label',
                  url: '/anggaran/belanja-sub-label',
                },
                {
                  title: 'Sub Output',
                  url: '/anggaran/belanja-sub-output',
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
            // {
            //   title: 'SKPD',
            //   url: '/worker/anggaran/skpd',
            // },
            {
              title: 'Sub Kegiatan',
              url: '/worker/anggaran/belanja-sub',
            },
            {
              title: 'Rinci Sub Kegiatan',
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
              title: 'API Keys',
              url: '/settings/api-keys',
              icon: KeyRound,
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
          url: '/about',
          icon: HelpCircle,
        },
      ],
    },
  ],
}
