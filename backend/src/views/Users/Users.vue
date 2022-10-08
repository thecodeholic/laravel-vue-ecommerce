<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-3xl font-semibold">Users</h1>
    <button type="button"
            @click="showAddNewModal()"
            class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    >
      Add new User
    </button>
  </div>
  <UsersTable @clickEdit="editUser"/>
  <UserModal v-model="showUserModal" :user="userModel" @close="onModalClose"/>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import store from "../../store";
import UserModal from "./UserModal.vue";
import UsersTable from "./UsersTable.vue";

const DEFAULT_USER = {
  id: '',
  title: '',
  description: '',
  image: '',
  price: ''
}

const users = computed(() => store.state.users);

const userModel = ref({...DEFAULT_USER})
const showUserModal = ref(false);

function showAddNewModal() {
  showUserModal.value = true
}

function editUser(u) {
    userModel.value = u;
    showAddNewModal();
}

function onModalClose() {
  userModel.value = {...DEFAULT_USER}
}
</script>

<style scoped>

</style>
