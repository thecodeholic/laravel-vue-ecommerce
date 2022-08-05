<template>
  <div>
    <label class="sr-only">{{ label }}</label>
    <template v-if="type === 'textarea'">
      <textarea :name="name"
                :required="required"
                :value="props.modelValue"
                @input="emit('update:modelValue', $event.target.value)"
                class="block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                :placeholder="label"></textarea>
    </template>
    <template v-else>
      <input :type="type"
             :name="name"
             :required="required"
             :value="props.modelValue"
             @input="emit('update:modelValue', $event.target.value)"
             class="block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
             :placeholder="label"/>
    </template>
  </div>
</template>

<script setup>

const props = defineProps({
  modelValue: String,
  label: String,
  type: {
    type: String,
    default: 'text'
  },
  name: String,
  required: Boolean
})

const emit = defineEmits(['update:modelValue'])

</script>

<style scoped>

</style>
