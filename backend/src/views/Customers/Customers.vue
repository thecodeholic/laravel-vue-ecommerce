<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-3xl font-semibold">Customers</h1>
  </div>
  <CustomersTable @clickEdit="editCustomer"/>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import store from "../../store";
import CustomersTable from "./CustomersTable.vue";

const DEFAULT_CUSTOMER = {
}

const customers = computed(() => store.state.customers);

const customerModel = ref({...DEFAULT_CUSTOMER})
const showCustomerModal = ref(false);

function showAddNewModal() {
  showCustomerModal.value = true
}

function editCustomer(c) {
  store.dispatch('getCustomer', c.id)
    .then(({data}) => {
      customerModel.value = data;
      showAddNewModal();
    })
}

function onModalClose() {
  customerModel.value = {...DEFAULT_CUSTOMER}
}
</script>

<style scoped>

</style>
