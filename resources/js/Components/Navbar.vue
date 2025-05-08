<template>
  <header class="fixed top-0 left-0 w-full z-50 bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto flex items-center py-2 px-4">
      <!-- 左侧 logo -->
      <div class="flex items-center">
        <img src="/images/logo/logo.png" alt="logo" class="h-15 w-20" />
      </div>
      <!-- 中间导航菜单，左侧加 margin-left:25px -->
      <nav class="flex items-center space-x-6 ml-[25px]">
        <Link
          href="/"
          class="hover:text-[#009FE8]"
          :class="url === '/' ? 'text-[#009FE8] font-bold' : 'text-gray-700'"
        >Home</Link>
        <Link
          href="/lessons"
          class="hover:text-[#009FE8]"
          :class="url.startsWith('/lessons') ? 'text-[#009FE8] font-bold' : 'text-gray-700'"
        >1V1 LESSON</Link>
        <Link
          href="/recorded"
          class="hover:text-[#009FE8]"
          :class="url.startsWith('/recorded') ? 'text-[#009FE8] font-bold' : 'text-gray-700'"
        >Recorded Lesson</Link>
        <Link
          href="/practice"
          class="hover:text-[#009FE8]"
          :class="url.startsWith('/practice') ? 'text-[#009FE8] font-bold' : 'text-gray-700'"
        >Daily Pratice</Link>
        <Link
          href="/about"
          class="hover:text-[#009FE8]"
          :class="url.startsWith('/about') ? 'text-[#009FE8] font-bold' : 'text-gray-700'"
        >About Me</Link>
        <Link
          href="/contact"
          class="hover:text-[#009FE8]"
          :class="url.startsWith('/contact') ? 'text-[#009FE8] font-bold' : 'text-gray-700'"
        >Contact</Link>
      </nav>
      <!-- <div class="flex flex-col items-end">
        <div class="flex items-center space-x-2">
          <svg class="w-5 h-5 text-[#009FE8]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M21 10.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4.5l-7-3.5-7 3.5" />
          </svg>
          <span class="text-xs font-semibold">email</span>
        </div>
        <span class="text-xs font-semibold text-gray-800">chineseteacherelena@outlook.com</span>
      </div> -->
    </div>
  </header>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
const url = usePage().url
</script>
