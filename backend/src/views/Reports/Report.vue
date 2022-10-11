<template>
  <div>
    <div class="grid gap-3 grid-cols-3">
      <div class="col-span-2 grid grid-cols-2 gap-3">
        <router-link :to="{name: 'reports.orders', params: route.params}"
                     class="bg-white py-2 px-3 text-gray-700 rounded-md text-center"
                     active-class="text-indigo-600 bg-indigo-50">Orders Report
        </router-link>
        <router-link :to="{name: 'reports.customers', params: route.params}"
                     class="bg-white py-2 px-3 text-gray-700 rounded-md text-center"
                     active-class="text-indigo-600 bg-indigo-50">Customers Report
        </router-link>
      </div>
      <div>
        <CustomInput type="select" v-model="chosenDate" @change="onDatePickerChange" :select-options="dateOptions"/>
      </div>
    </div>
    <div class="bg-white p-3 rounded-md mt-3 shadow-md">
      <router-view />
    </div>
  </div>
</template>

<script setup>
import {computed, ref} from "vue";
import CustomInput from "../../components/core/CustomInput.vue";
import {useRoute, useRouter} from "vue-router";
import {useStore} from "vuex";

const store = useStore()
const router = useRouter();
const route = useRoute();
const dateOptions = computed(() => store.state.dateOptions);
const chosenDate = ref('all')

function onDatePickerChange() {
  router.push({name: route.name, params: {date: chosenDate.value}})
}
</script>

<style scoped>

</style>
