export type * from './models'

export interface LaravelValidationError {
  message: string
  errors: {
    [field: string]: string[]
  }
}
