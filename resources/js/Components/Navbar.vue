<template>
  <header class="w-full border-b border-gray-200">
    <div class="max-w-7xl mx-auto flex items-center justify-between py-2 px-4">
      <div class="flex items-center space-x-2">
        <img src="/images/logo/logo.png" alt="logo" class="h-10 w-10" />
        <span class="font-bold text-lg tracking-wide">ELENA MANDARIN</span>
      </div>
      <nav class="flex-1 flex items-center justify-center space-x-6">
        <Link href="/" class="text-[#009FE8] font-semibold" :class="{ 'font-bold underline': url === '/' }">Home</Link>
        <Link href="/lessons" class="text-gray-700 hover:text-[#009FE8]" :class="{ 'text-[#009FE8] font-semibold underline': url.startsWith('/lessons') }">1V1 LESSON</Link>
        <Link href="/recorded" class="text-gray-700 hover:text-[#009FE8]">Recorded Lesson</Link>
        <Link href="/practice" class="text-gray-700 hover:text-[#009FE8]">Daily Pratice</Link>
        <Link href="/about" class="text-gray-700 hover:text-[#009FE8]">About Me</Link>
        <Link href="/contact" class="text-gray-700 hover:text-[#009FE8]">Contact</Link>
      </nav>
      <div class="flex flex-col items-end">
        <div class="flex items-center space-x-2">
          <svg class="w-5 h-5 text-[#009FE8]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M21 10.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4.5l-7-3.5-7 3.5" />
          </svg>
          <span class="text-xs font-semibold">email</span>
        </div>
        <span class="text-xs font-semibold text-gray-800">chineseteacherelena@outlook.com</span>
      </div>
    </div>
  </header>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
const url = usePage().url
</script>
