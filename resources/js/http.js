
export function request(method, url, data = {}) {
  return fetch(url, {
    method,
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
      // 'Content-Type': 'application/x-www-form-urlencoded',
    },
    ...(method === 'get' ? {}: {body: JSON.stringify(data)})
  }).then(async (response) => {
    if (response.status >=200 && response.status <300) {
      return response.json()
    }
    throw await response.json();
  })
}

export function get(url) {
  return request('get', url)
}

export function post(url, data) {
  return request('post', url, data)
}
