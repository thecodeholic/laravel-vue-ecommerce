export default {
  user: {
    token: sessionStorage.getItem('TOKEN'),
    data: {}
  },
  products: {
    loading: false,
    data: [],
    links: [],
    from: null,
    to: null,
    page: 1,
    limit: null,
    total: null
  },
  users: {
    loading: false,
    data: [],
    links: [],
    from: null,
    to: null,
    page: 1,
    limit: null,
    total: null
  },
  customers: {
    loading: false,
    data: [],
    links: [],
    from: null,
    to: null,
    page: 1,
    limit: null,
    total: null
  },
  countries: [],
  orders: {
    loading: false,
    data: [],
    links: [],
    from: null,
    to: null,
    page: 1,
    limit: null,
    total: null
  },
  toast: {
    show: false,
    message: '',
    delay: 5000
  }
}
