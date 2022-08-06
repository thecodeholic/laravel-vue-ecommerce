<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-3xl font-semibold">Products</h1>
    <button type="button"
            @click="showAddNewModal()"
            class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    >
      Add new Product
    </button>
  </div>
  <ProductsTable />
  <ProductModal v-model="showProductModal" :product="product"/>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import store from "../../store";
import ProductModal from "./ProductModal.vue";
import ProductsTable from "./ProductsTable.vue";

const products = computed(() => store.state.products);

const product = ref({})
const showProductModal = ref(false);

function showAddNewModal() {
  showProductModal.value = true
}
</script>

<style scoped>

</style>
