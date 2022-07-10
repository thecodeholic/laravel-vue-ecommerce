<template>
  <div class="min-h-full bg-gray-200 flex">
    <!--    Sidebar-->
    <Sidebar :class="{'-ml-[200px]': !sidebarOpened}"/>
    <!--/    Sidebar-->

    <div class="flex-1">
      <TopHeader @toggle-sidebar="toggleSidebar"></TopHeader>
      <!--      Content-->
      <main class="p-6">
        <router-view></router-view>
      </main>
      <!--      Content-->
    </div>
  </div>
</template>

<script setup>
import {ref} from 'vue'
import Sidebar from "./Sidebar.vue";
import TopHeader from "./TopHeader.vue";

const {title} = defineProps({
  title: String
})

const sidebarOpened = ref(true);

function toggleSidebar() {
  sidebarOpened.value = !sidebarOpened.value
}
</script>

<style scoped>

</style>
