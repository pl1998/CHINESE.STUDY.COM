<template>
  <!-- 顶部广告栏，fixed在最上方 -->
  <div class="fixed top-0 left-0 w-full z-50 bg-[#7a8b6a]  text-white text-sm h-8 flex items-center">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 w-full">
      <div class="flex items-center space-x-6">
        <span>
          <font-awesome-icon :icon="['fas', 'phone-alt']" class="mr-1" />
          {{ config.ipone }}
        </span>
        <span>
          <font-awesome-icon :icon="['fas', 'envelope']" class="mr-1" />
          {{ config.email }}
        </span>
      </div>
      <div class="flex items-center space-x-3">
        <a :href="config.instagram_url" target="_blank" class="hover:text-gray-200 transition-colors">
          <font-awesome-icon :icon="['fab', 'instagram']" />
        </a>
        <a :href="config.tiktok_url" target="_blank" class="hover:text-gray-200 transition-colors">
          <font-awesome-icon :icon="['fab', 'tiktok']" />
        </a>
        <a :href="config.youtube_url" target="_blank" class="hover:text-gray-200 transition-colors">
          <font-awesome-icon :icon="['fab', 'youtube']" />
        </a>
      </div>
    </div>
  </div>
  <!-- 主导航栏，fixed并且top-8（32px）紧贴广告栏下方 -->
  <header class="fixed top-8 left-0 w-full z-40 bg-white border-b border-gray-200 h-20">
    <div class="max-w-7xl mx-auto flex items-center h-20 px-4">
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
    </div>
  </header>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'

const props = defineProps({
  config: {
    type: Object,
    required: true,
    default: () => ({
      ipone: '',
      email: '',
      instagram_url: '#',
      tiktok_url: '#',
      youtube_url: '#'
    })
  }
})

const url = usePage().url
</script>