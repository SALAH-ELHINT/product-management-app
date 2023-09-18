<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});


const navigation = [
    { name: 'About Me', href: '/AboutMe' },
    { name: 'Home', href: '/' },
]

const navigationForUsers = [
    { name: 'Product', href: '/product' },
]

const mobileMenuOpen = ref(false)




</script>

<template>
      <header class="absolute inset-x-0 top-0 z-50">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
          <div class="flex lg:flex-1">
            <a href="https://www.linkedin.com/in/salah-elhint-70447925b/" class="-m-1.5 p-1.5">
              SALAH
            </a>
          </div>
          <div class="hidden lg:flex lg:gap-x-12">
            <!-- for navigationForUsers if his user -->
            
            <a v-if="$page.props.auth.user" v-for="item in navigationForUsers" :key="item.name" :href="item.href" class="text-sm font-semibold leading-6 text-gray-900">{{ item.name }}</a>

            <a v-for="item in navigation" :key="item.name" :href="item.href" class="text-sm font-semibold leading-6 text-gray-900">{{ item.name }}</a>
          </div>


          <div class="hidden lg:flex lg:flex-1 lg:justify-end" >
                <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm font-semibold leading-6 text-gray-900 hover:text-blue-500 transition duration-300 ease-in-out transform hover:translate-x-1">dashboard <span aria-hidden="true">&rarr;</span></Link>
                <template v-else>
                        <Link :href="route('login')" class="text-sm font-semibold leading-6 text-gray-900 hover:text-blue-500 transition duration-300 ease-in-out transform hover:translate-x-1">
                        Log in <span aria-hidden="true">&rarr;</span>
                        </Link>
                        <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm font-semibold leading-6 text-gray-900 hover:text-blue-500 transition duration-300 ease-in-out transform hover:translate-x-1">
                        Register <span aria-hidden="true">&rarr;</span>
                        </Link>
                </template>
          </div>


          
        </nav>


        <Dialog as="div" class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
          <div class="fixed inset-0 z-50" />
          <DialogPanel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between">
              <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">Your Company</span>
                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
              </a>
              <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
                <span class="sr-only">Close menu</span>
                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
              </button>
            </div>
            <div class="mt-6 flow-root">
              <div class="-my-6 divide-y divide-gray-500/10">
                <div class="space-y-2 py-6">
                  <a v-for="item in navigation" :key="item.name" :href="item.href" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ item.name }}</a>
                </div>
                <div class="py-6">
                  <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</a>
                </div>
              </div>
            </div>
          </DialogPanel>
        </Dialog>
      </header>
  
  </template>
  
  