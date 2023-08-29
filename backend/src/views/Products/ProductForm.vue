<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div id="product-form">
    <div class="flex items-center justify-between mb-3">
      <h1 class="text-3xl font-semibold">{{ product.id ? `Update product: "${product.title}"` : 'Create new Product' }}</h1>
    </div>
    <Spinner v-if="loading"
             class="p-5 z-[100] absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center"/>
    <form @submit.prevent="onSubmit">
      <div class="bg-white px-4 pt-5 pb-4 z-50">
        <CustomInput class="mb-2" v-model="product.title" label="Product Title"/>
        <CustomInput type="file" class="mb-2" label="Product Image" @change="file => product.image = file"/>
        <CustomInput type="richtext" class="mb-2" v-model="product.description" label="Description"/>
        <CustomInput type="number" class="mb-2" v-model="product.price" label="Price" prepend="$"/>
        <CustomInput type="number" class="mb-2" v-model="product.quantity" label="Quantity"/>
        <CustomInput type="checkbox" class="mb-2" v-model="product.published" label="Published"/>


      </div>
      <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="submit"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm
                          text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
          Save
        </button>
        <button type="button"
                @click="onSubmit($event, true)"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm
                          text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
          Save and Close
        </button>
        <router-link :to="{name: 'app.products'}"
                     class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
          Cancel
        </router-link>
      </footer>
    </form>
  </div>
</template>

<script setup>
import {computed, onMounted, ref} from 'vue'
import CustomInput from "../../components/core/CustomInput.vue";
import store from "../../store/index.js";
import Spinner from "../../components/core/Spinner.vue";
import {useRoute, useRouter} from "vue-router";

const product = ref({
  id: null,
  title: null,
  image: null,
  description: '',
  price: null,
  published: null
})

const loading = ref(false)

const router = useRouter();
const route = useRoute();

onMounted(() => {
  if (route.params.id) {
    loading.value = true
    store.dispatch('getProduct', route.params.id)
      .then(({data}) => {
        loading.value = false
        product.value = data
      })
  }
})

function onSubmit(event, close = false) {
  loading.value = true
  if (product.value.id) {
    store.dispatch('updateProduct', product.value)
      .then(response => {
        loading.value = false;
        if (response.status === 200) {
          store.commit('showToast', 'Product was successfully updated')
          store.dispatch('getProducts')
          if (close) {
            router.push({name: 'app.products'})
          }
        }
      })
  } else {
    store.dispatch('createProduct', product.value)
      .then(response => {
        loading.value = false;
        if (response.status === 201) {
          store.commit('showToast', 'Product was successfully created')
          store.dispatch('getProducts')
          if (close) {
            router.push({name: 'app.products'})
          }
        }
      })
      .catch(err => {
        loading.value = false;
      })
  }
}
</script>
<style>
#product-form {
  position: relative;
}
</style>
