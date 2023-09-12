<template>
  <div class="flex flex-wrap gap-1">
    <div v-for="image of imageUrls"
         class="relative w-[120px] h-[120px] rounded border border-dashed flex items-center justify-center hover:border-purple-500 overflow-hidden">
      <img :src="image.url" class="max-w-full max-h-full" :class="image.deleted ? 'opacity-50' : ''">
      <span v-if="image.deleted" class="absolute left-0 bottom-0 right-0 py-1 px-2 bg-black w-100 text-white text-center flex">
        To be deleted
      </span>
      <span class="absolute top-1 right-1 cursor-pointer" @click="removeImage(image)">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
          <path
            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
        </svg>
      </span>
    </div>
    <div
      class="relative w-[120px] h-[120px] rounded border border-dashed flex items-center justify-center hover:border-purple-500 overflow-hidden">
      <span>
        Upload
      </span>
      <input type="file" class="absolute left-0 top-0 bottom-0 right-0 w-full h-full opacity-0"
             @change="onFileChange" multiple>
    </div>
  </div>
</template>

<script setup>
// Imports
import {v4 as uuidv4} from 'uuid';
import {onMounted, ref, watch} from "vue";

// Uses

// Refs

const files = ref([])
const imageUrls = ref([])
const deletedImages = ref([])

// Props & Emit
const props = defineProps(['modelValue', 'deletedImages', 'images'])
const emit = defineEmits(['update:modelValue', 'update:deletedImages'])

// Computed

// Methods
function onFileChange($event) {
  const chosenFiles = [...$event.target.files];
  files.value = [...files.value, ...chosenFiles];
  $event.target.value = ''
  for (let file of chosenFiles) {
    file.id = uuidv4()
    readFile(file)
      .then(url => {
        imageUrls.value.push({
          url,
          id: file.id
        })
      })
  }
  emit('update:modelValue', files.value)
}

function readFile(file) {
  return new Promise((resolve, reject) => {
    const fileReader = new FileReader()
    fileReader.readAsDataURL(file)
    fileReader.onload = () => {
      resolve(fileReader.result)
    }
    fileReader.onerror = reject
  })
}

function removeImage(image) {
  if (image.isProp) {
    deletedImages.value.push(image.id)
    image.deleted = true;

    emit('update:deletedImages', deletedImages.value)
  } else {
    files.value = files.value.filter(f => f.id !== image.id)
    imageUrls.value = imageUrls.value.filter(f => f.id !== image.id)

    emit('update:modelValue', files.value)
  }
}

// Hooks
watch('props.images', () => {
  console.log(props.images)
  imageUrls.value = [
    ...imageUrls.value,
    ...props.images.map(im => ({
      ...im,
      isProp: true
    }))
  ]
}, {immediate: true, deep: true})
onMounted(() => {
  emit('update:modelValue', [])
  emit('update:deletedImages', deletedImages.value)
})

</script>

<style scoped>

</style>
