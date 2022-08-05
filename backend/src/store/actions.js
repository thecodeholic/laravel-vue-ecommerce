import axiosClient from "../axios";

export function getUser({commit}, data) {
  return axiosClient.get('/user', data)
    .then(({data}) => {
      commit('setUser', data);
      return data;
    })
}

export function login({commit}, data) {
  return axiosClient.post('/login', data)
    .then(({data}) => {
      commit('setUser', data.user);
      commit('setToken', data.token)
      return data;
    })
}

export function logout({commit}) {
  return axiosClient.post('/logout')
    .then((response) => {
      commit('setToken', null)

      return response;
    })
}

export function getProducts({commit, state}, {url = null, search, per_page, sort_field, sort_direction}) {
  commit('setProducts', [true])
  url = url || '/products'
  const params = {
    per_page: state.products.limit,
  }
  return axiosClient.get(url, {
    params: {
      ...params,
      search, per_page, sort_field, sort_direction
    }
  })
    .then((response) => {
      commit('setProducts', [false, response.data])
    })
    .catch(() => {
      commit('setProducts', [false])
    })
}

export function  createProduct({commit}, product) {
  return axiosClient.post('/products', product)
}
