<template>
  <GuestLayout title="Request new password">
    <form class="mt-8 space-y-6" action="#" method="POST">
      <input type="hidden" name="remember" value="true"/>
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="email-address" class="sr-only">Email address</label>
          <input id="email-address" name="email" type="email" autocomplete="email" required=""
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                 placeholder="Email address"/>
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="text-sm">
          <router-link :to="{name: 'login'}" class="font-medium text-indigo-600 hover:text-indigo-500"> Remember your
            password?
          </router-link>
        </div>
      </div>

      <div>
        <button type="submit"
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true"/>
            </span>
          Submit
        </button>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import {LockClosedIcon} from '@heroicons/vue/solid'
import GuestLayout from "../components/GuestLayout.vue";
</script>
