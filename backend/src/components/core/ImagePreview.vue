<template>
  <div class="flex gap-2">
    <div class="flex gap-1 flex-wrap">
      <div v-for="image of imageUrls"
           class="w-[120px] h-[120px] rounded border border-dashed flex items-center justify-center relative hover:border-purple-500">
        <small v-if="image.deleted"
               class="absolute left-0 bottom-0 py-1 px-2 bg-black w-full text-white text-center flex">
          To be deleted
          <span @click="revertDeletedImage(image)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-4 h-4 ml-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/>
            </svg>
          </span>
        </small>
        <img :src="image.url" class="max-w-full max-h-full" :class="image.deleted ? 'opacity-50' : ''">
        <span class="absolute top-1 right-1 cursor-pointer" @click="removeImage(image)">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </span>
      </div>
      <div
        class="relative w-[120px] h-[120px] rounded border border-dashed flex items-center justify-center hover:border-purple-500 overflow-hidden">
        <span>
          Upload
        </span>
        <input type="file" class="absolute left-0 top-0 right-0 bottom-0 z-50 opacity-0" @change="onFileChange"
               multiple/>
      </div>
    </div>
  </div>
</template>

<script setup>
// Imports
import {onMounted, onUpdated, ref, watch} from "vue";
import {v4 as uuidv4} from 'uuid';

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
  files.value = [...files.value, ...$event.target.files]
  for (let file of $event.target.files) {
    file.id = uuidv4()
    readFile(file)
      .then((url) => {
        imageUrls.value.push({
          id: file.id,
          url: url
        })
      })
  }
  emit('update:modelValue', files.value)
}

function readFile(file) {
  return new Promise((resolve, reject) => {
    const fileReader = new FileReader()
    fileReader.readAsDataURL(file);
    fileReader.onload = function () {
      resolve(fileReader.result)
    };
    fileReader.onerror = function (error) {
      reject(null)
    };
  })
}

function removeImage(image) {
  if (image.isProp) {
    deletedImages.value.push(image.id)
    image.deleted = true
    // imageUrls.value = imageUrls.value.filter(im => im.id !== image.id)
    emit('update:deletedImages', deletedImages.value)
  } else {
    files.value = files.value.filter(f => f.id !== image.id)
    imageUrls.value = imageUrls.value.filter(im => im.id !== image.id)
    emit('update:modelValue', files.value)
  }
}

function revertDeletedImage(image) {
  image.deleted = false;
  deletedImages.value = deletedImages.value.filter(id => id !== image.id);
  emit('update:deletedImages', deletedImages.value)
}


// Hooks
watch('props.images', () => {
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
})


</script>

<style scoped>

</style>
