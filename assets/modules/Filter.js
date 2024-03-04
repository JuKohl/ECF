export default class Filter {
  constructor (element) {
    if (element === null) {
      return
    }
    this.pagination = element.querySelector('.js-filter-pagination')
    this.content = element.querySelector('.js-filter-content')
    this.form = element.querySelector('.js-filter-form')
  }
  
  async loadUrl (url, append = false) {
    const ajaxUrl = url + '&ajax=1'
    const response = await fetch(ajaxUrl, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
    if (response.status >= 200 && response.status < 300) {
      const data = await response.json()
      this.content.innerHTML = data.content
    } else {
      console.error(response)
    }
  }
}