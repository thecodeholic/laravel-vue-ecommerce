<template>
  <button class="w-7 h-7 bg-indigo-500 hover:bg-indigo-600 rounded text-white"
          @click="emit('click')">
    <slot></slot>
  </button>
</template>

<script setup>
const emit = defineEmits(['click'])

</script>

<style scoped>

</style>
