<template>
  <th @click="emit('click')" class="border-b-2 p-2 text-left cursor-pointer bg-gray-100"
  :class="field === sortField ? 'bg-blue-50' : ''">
    <div class="flex justify-between">
      <slot></slot>
      <div v-if="sortField === field" class="ml-2">
        <!--              Sort Asc-->
        <svg v-if="sortDirection === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
        </svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"/>
        </svg>
      </div>
    </div>
  </th>
</template>

<script setup>

const {field, sortField, sortDirection} = defineProps({
  field: String,
  sortField: String,
  sortDirection: String
})

const emit = defineEmits(['click'])

</script>

<style scoped>

</style>
