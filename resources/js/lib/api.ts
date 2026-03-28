import axios from 'axios'

const baseURL = import.meta.env.VITE_APP_URL || import.meta.env.APP_URL

const api = axios.create({
  ...(baseURL && { baseURL: baseURL }),
  withCredentials: true,
  withXSRFToken: true,
  headers: {
    Accept: 'application/json',
    // 'Content-Type': 'application/json',
    // 'X-Requested-With': 'XMLHttpRequest',
  },
})

export default api
