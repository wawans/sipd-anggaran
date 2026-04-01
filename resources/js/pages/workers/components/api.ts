import { queryOptions } from '@tanstack/react-query'
import axios from '@/lib/api'

const URL: string = '/api/getter/anggaran/belanja/sub'

export async function fetchAll() {
  return axios.get(URL).then((r) => r.data)
}

export async function show(id: number | string) {
  return axios.get(URL + '/' + id).then((r) => r.data)
}

export async function create(data: any) {
  return axios.post(URL, data).then((r) => r.data)
}

export async function update(id: number | string, data: any) {
  return axios.put(URL + '/' + id, data).then((r) => r.data)
}

export async function destroy(id: number | string) {
  return axios.delete(URL + '/' + id).then((r) => r.data)
}

export async function destroys(data: any) {
  return axios.post(URL + '/destroys', data).then((r) => r.data)
}

export const allQueryOptions = queryOptions({
  queryKey: ['workers', { url: URL }],
  queryFn: () => fetchAll(),
})

export const showQueryOptions = (id: number | string) =>
  queryOptions({
    queryKey: ['workers', { url: URL, id }],
    queryFn: () => show(id),
  })


