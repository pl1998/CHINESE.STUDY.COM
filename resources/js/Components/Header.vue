<template>
  <nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">
          <!-- Logo -->
          <div class="flex-shrink-0 flex items-center">
            <Link href="/">
              <img class="h-8 w-auto" src="/images/logo/logo.png" alt="Elena Mandarin" />
            </Link>
          </div>

          <!-- Navigation Links -->
          <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
            <Link 
              v-for="item in navigationItems" 
              :key="item.name"
              :href="item.href"
              class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900"
              :class="{ 'border-b-2 border-indigo-500': $page.url.startsWith(item.href) }"
            >
              {{ item.name }}
            </Link>
          </div>
        </div>

        <!-- Mobile menu button -->
        <div class="flex items-center sm:hidden">
          <button 
            @click="isMobileMenuOpen = !isMobileMenuOpen"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100"
          >
            <span class="sr-only">Open main menu</span>
            <svg 
              class="h-6 w-6" 
              :class="{ 'hidden': isMobileMenuOpen, 'block': !isMobileMenuOpen }"
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke="currentColor"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg 
              class="h-6 w-6" 
              :class="{ 'block': isMobileMenuOpen, 'hidden': !isMobileMenuOpen }"
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke="currentColor"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu -->
    <div 
      class="sm:hidden" 
      :class="{ 'block': isMobileMenuOpen, 'hidden': !isMobileMenuOpen }"
    >
      <div class="pt-2 pb-3 space-y-1">
        <Link 
          v-for="item in navigationItems" 
          :key="item.name"
          :href="item.href"
          class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50"
          :class="{ 'bg-indigo-50 border-l-4 border-indigo-500': $page.url.startsWith(item.href) }"
        >
          {{ item.name }}
        </Link>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const isMobileMenuOpen = ref(false);

const navigationItems = [
  { name: '1V1 LESSON', href: '/lessons' },
  { name: 'Recorded Lesson', href: '/recorded' },
  { name: 'Daily Practice', href: '/practice' },
  { name: 'About Me', href: '/about' },
  { name: 'Contact', href: '/contact' },
];
</script> 