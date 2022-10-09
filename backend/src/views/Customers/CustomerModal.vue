<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <TransitionRoot as="template" :show="show">
    <Dialog as="div" class="relative z-10" @close="show = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
                       leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-black bg-opacity-70 transition-opacity"/>
      </TransitionChild>

      <div class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300"
                           enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                           enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                           leave-from="opacity-100 translate-y-0 sm:scale-100"
                           leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel
              class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-[700px] sm:w-full">
              <Spinner v-if="loading"
                       class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center"/>
              <header class="py-3 px-4 flex justify-between items-center">
                <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                  {{ customer.id ? `Update customer: "${props.customer.first_name} ${props.customer.last_name}"` : 'Create new Customer' }}
                </DialogTitle>
                <button
                  @click="closeModal()"
                  class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"
                    />
                  </svg>
                </button>
              </header>
              <form @submit.prevent="onSubmit">
                <div class="bg-white px-4 pt-5 pb-4">
                  <CustomInput class="mb-2" v-model="customer.first_name" label="First Name"/>
                  <CustomInput class="mb-2" v-model="customer.last_name" label="Last Name"/>
                  <CustomInput class="mb-2" v-model="customer.email" label="Email"/>
                  <CustomInput class="mb-2" v-model="customer.phone" label="Phone"/>
                  <CustomInput type="checkbox" class="mb-2" v-model="customer.status" label="Active"/>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                      <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">Billing Address</h2>

                      <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <CustomInput v-model="customer.billingAddress.address1" label="Address 1"/>
                        <CustomInput v-model="customer.billingAddress.address2" label="Address 2"/>
                        <CustomInput v-model="customer.billingAddress.city" label="City"/>
                        <CustomInput v-model="customer.billingAddress.zipcode" label="Zip Code"/>

                        <CustomInput type="select" :select-options="countries" v-model="customer.billingAddress.country_code" label="Country"/>
                        <CustomInput v-if="!billingCountry.states" v-model="customer.billingAddress.state" label="State"/>
                        <CustomInput v-else type="select" :select-options="billingStateOptions" v-model="customer.billingAddress.state" label="State"/>
                      </div>
                    </div>

                    <div>
                      <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">Shipping Address</h2>

                      <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <CustomInput  v-model="customer.shippingAddress.address1" label="Address 1"/>
                        <CustomInput  v-model="customer.shippingAddress.address2" label="Address 2"/>
                        <CustomInput  v-model="customer.shippingAddress.city" label="City"/>
                        <CustomInput  v-model="customer.shippingAddress.zipcode" label="Zip Code"/>
                        <CustomInput type="select" :select-options="countries" v-model="customer.shippingAddress.country_code" label="Country"/>
                        <CustomInput v-if="!shippingCountry.states" v-model="customer.shippingAddress.state" label="State"/>
                        <CustomInput v-else type="select" :select-options="shippingStateOptions" v-model="customer.shippingAddress.state" label="State"/>
                      </div>
                    </div>
                  </div>

                </div>
                <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                  <button type="submit"
                          class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm
                          text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                    Submit
                  </button>
                  <button type="button"
                          class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                          @click="closeModal" ref="cancelButtonRef">
                    Cancel
                  </button>
                </footer>
              </form>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import {computed, onUpdated, ref} from 'vue'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import {ExclamationIcon} from '@heroicons/vue/outline'
import CustomInput from "../../components/core/CustomInput.vue";
import store from "../../store/index.js";
import Spinner from "../../components/core/Spinner.vue";

console.log(props.customer);
const customer = ref({
  billingAddress: {},
  shippingAddress: {}
})

const loading = ref(false)

const props = defineProps({
  modelValue: Boolean,
  customer: {
    required: true,
    type: Object,
  }
})

const emit = defineEmits(['update:modelValue', 'close'])

const show = computed({
  get: () => props.modelValue,
  set: (value) => emit('update:modelValue', value)
})
const countries = computed(() => store.state.countries.map(c => ({key: c.code, text: c.name})))
const billingCountry = computed(() => store.state.countries.find(c => c.code === customer.value.billingAddress.country_code))
const billingStateOptions = computed(() => {
  if (!billingCountry.value || !billingCountry.value.states) return [];

  return Object.entries(billingCountry.value.states).map(c => ({key: c[0], text: c[1]}))
})
const shippingCountry = computed(() => store.state.countries.find(c => c.code === customer.value.shippingAddress.country_code))
const shippingStateOptions = computed(() => {
  if (!shippingCountry.value || !shippingCountry.value.states) return [];

  return Object.entries(shippingCountry.value.states).map(c => ({key: c[0], text: c[1]}))
})

onUpdated(() => {
  customer.value = {
    id: props.customer.id,
    first_name: props.customer.first_name,
    last_name: props.customer.last_name,
    email: props.customer.email,
    phone: props.customer.phone,
    status: props.customer.status,
    billingAddress: {
      ...props.customer.billingAddress
    },
    shippingAddress: {
      ...props.customer.shippingAddress
    }
  }
})

function closeModal() {
  show.value = false
  emit('close')
}

function onSubmit() {
  loading.value = true
  if (customer.value.id) {
    console.log(customer.value.status);
    customer.value.status = !!customer.value.status
    store.dispatch('updateCustomer', customer.value)
      .then(response => {
        loading.value = false;
        if (response.status === 200) {
          // TODO show notification
          store.dispatch('getCustomers')
          closeModal()
        }
      })
  } else {
    store.dispatch('createCustomer', customer.value)
      .then(response => {
        loading.value = false;
        if (response.status === 201) {
          // TODO show notification
          store.dispatch('getCustomers')
          closeModal()
        }
      })
      .catch(err => {
        loading.value = false;
        debugger;
      })
  }
}
</script>
