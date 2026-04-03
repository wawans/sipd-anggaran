export function numberFormat(
  num: number,
  locale: string = 'id-ID',
  options: Intl.NumberFormatOptions = {}
) {
  return new Intl.NumberFormat(locale, options).format(num)
}
