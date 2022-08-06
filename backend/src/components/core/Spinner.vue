<template>
  <div class="flex flex-col items-center py-8">
    <svg
      class="animate-spin -ml-1 h-8 w-8 text-gray-700"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
    >
      <circle
        class="opacity-25"
        cx="12"
        cy="12"
        r="10"
        stroke="currentColor"
        stroke-width="4"
      ></circle>
      <path
        class="opacity-75"
        fill="currentColor"
        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
      ></path>
    </svg>
    <div class="mt-2">{{text}}</div>
  </div>
</template>

<script setup>

const {text} = defineProps({
  text: {
    type: String,
    default: 'Please Wait...'
  }
})

</script>

<style scoped>

</style>
