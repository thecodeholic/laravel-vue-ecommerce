import {createApp} from 'vue'
import CKEditor from '@ckeditor/ckeditor5-vue';

import store from './store'
import router from './router'
import './index.css';
import currencyUSD from './filters/currency.js'

import App from './App.vue'

const app = createApp(App);

app
  .use(store)
  .use(router)
  .use( CKEditor )
  .mount('#app')
;

app.config.globalProperties.$filters = {
  currencyUSD
}
