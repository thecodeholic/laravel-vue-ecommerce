<script setup>
import {ref, computed} from 'vue'
import store from "../store";

const test = computed(() => store.state.test)

defineProps({
  msg: String
})

const count = ref(0)
</script>

<template>
  {{ test }}
</template>

<style scoped>
a {
  color: #42b983;
}
</style>
