<template>
  <div class="bg-white p-4 rounded-lg shadow animate-fade-in-down">
    <div class="flex justify-between border-b-2 pb-3">
      <div class="flex items-center">
        <span class="ml-3">Found {{categories.data.length}} categories</span>
      </div>
    </div>

    <table class="table-auto w-full">
      <thead>
      <tr>
        <TableHeaderCell field="id" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortCategories('id')">
          ID
        </TableHeaderCell>
        <TableHeaderCell field="name" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortCategories('email')">
          Name
        </TableHeaderCell>
        <TableHeaderCell field="slug" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortCategories('slug')">
          Slug
        </TableHeaderCell>
        <TableHeaderCell field="active" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortCategories('active')">
          Active
        </TableHeaderCell>
        <TableHeaderCell field="parent_id" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortCategories('parent_id')">
          Parent
        </TableHeaderCell>
        <TableHeaderCell field="created_at" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortCategories('created_at')">
          Create Date
        </TableHeaderCell>
        <TableHeaderCell field="actions">
          Actions
        </TableHeaderCell>
      </tr>
      </thead>
      <tbody v-if="categories.loading || !categories.data.length">
      <tr>
        <td colspan="7">
          <Spinner v-if="categories.loading"/>
          <p v-else class="text-center py-8 text-gray-700">
            There are no categories
          </p>
        </td>
      </tr>
      </tbody>
      <tbody v-else>
      <tr v-for="(category, index) of categories.data">
        <td class="border-b p-2 ">{{ category.id }}</td>
        <td class="border-b p-2 ">
         {{ category.name }}
        </td>
        <td class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis">
          {{ category.slug }}
        </td>
        <td class="border-b p-2">
          {{ category.active ? 'Yes' : 'No' }}
        </td>
        <td class="border-b p-2">
          {{ category.parent?.name }}
        </td>
        <td class="border-b p-2">
          {{ category.created_at }}
        </td>
        <td class="border-b p-2 ">
          <Menu as="div" class="relative inline-block text-left">
            <div>
              <MenuButton
                class="inline-flex items-center justify-center w-full justify-center rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-white hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
              >
                <DotsVerticalIcon
                  class="h-5 w-5 text-indigo-500"
                  aria-hidden="true"/>
              </MenuButton>
            </div>

            <transition
              enter-active-class="transition duration-100 ease-out"
              enter-from-class="transform scale-95 opacity-0"
              enter-to-class="transform scale-100 opacity-100"
              leave-active-class="transition duration-75 ease-in"
              leave-from-class="transform scale-100 opacity-100"
              leave-to-class="transform scale-95 opacity-0"
            >
              <MenuItems
                class="absolute z-10 right-0 mt-2 w-32 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
              >
                <div class="px-1 py-1">
                  <MenuItem v-slot="{ active }">
                    <button
                      :class="[
                        active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                        'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                      ]"
                      @click="editCategory(category)"
                    >
                      <PencilIcon
                        :active="active"
                        class="mr-2 h-5 w-5 text-indigo-400"
                        aria-hidden="true"
                      />
                      Edit
                    </button>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <button
                      :class="[
                        active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                        'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                      ]"
                      @click="deleteCategory(category)"
                    >
                      <TrashIcon
                        :active="active"
                        class="mr-2 h-5 w-5 text-indigo-400"
                        aria-hidden="true"
                      />
                      Delete
                    </button>
                  </MenuItem>
                </div>
              </MenuItems>
            </transition>
          </Menu>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import store from "../../store";
import Spinner from "../../components/core/Spinner.vue";
import TableHeaderCell from "../../components/core/Table/TableHeaderCell.vue";
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
import {DotsVerticalIcon, PencilIcon, TrashIcon} from '@heroicons/vue/outline'
import CategoryModal from "./CategoryModal.vue";

const categories = computed(() => store.state.categories);
const sortField = ref('updated_at');
const sortDirection = ref('desc')

const category = ref({})
const showCategoryModal = ref(false);

const emit = defineEmits(['clickEdit'])

onMounted(() => {
  getCategories();
})

function getForPage(ev, link) {
  ev.preventDefault();
  if (!link.url || link.active) {
    return;
  }

  getCategories(link.url)
}

function getCategories(url = null) {
  store.dispatch("getCategories", {
    url,
    sort_field: sortField.value,
    sort_direction: sortDirection.value
  });
}

function sortCategories(field) {
  if (field === sortField.value) {
    if (sortDirection.value === 'desc') {
      sortDirection.value = 'asc'
    } else {
      sortDirection.value = 'desc'
    }
  } else {
    sortField.value = field;
    sortDirection.value = 'asc'
  }

  getCategories()
}

function showAddNewModal() {
  showCategoryModal.value = true
}

function deleteCategory(category) {
  if (!confirm(`Are you sure you want to delete the category?`)) {
    return
  }
  store.dispatch('deleteCategory', category)
    .then(res => {
      store.commit('showToast', 'Category was successfully deleted');
      store.dispatch('getCategories')
    })
}

function editCategory(p) {
  emit('clickEdit', p)
}
</script>

<style scoped>

</style>
