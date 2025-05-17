<template>
  <!-- 顶部广告栏，fixed在最上方 -->
  <div class="fixed top-0 left-0 w-full z-50 bg-[#009FE8] text-white text-base h-[50px] flex items-center">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 w-full">
      <div class="flex items-center space-x-6">
        <span>
          <font-awesome-icon :icon="['fas', 'phone-alt']" class="mr-1 text-xl" />
          {{ config.ipone }}
        </span>
        <span>
          <font-awesome-icon :icon="['fas', 'envelope']" class="mr-1 text-xl" />
          {{ config.email }}
        </span>
      </div>
      <div class="flex items-center space-x-3">
        <a :href="config.instagram_url" target="_blank" class="text-white hover:text-[#009FE8] transition-colors">
          <font-awesome-icon :icon="['fab', 'instagram']" class="text-xl" />
        </a>
        <a :href="config.tiktok_url" target="_blank" class="text-white hover:text-[#009FE8] transition-colors">
          <font-awesome-icon :icon="['fab', 'tiktok']" class="text-xl" />
        </a>
        <a :href="config.youtube_url" target="_blank" class="text-white hover:text-[#009FE8] transition-colors">
          <font-awesome-icon :icon="['fab', 'youtube']" class="text-xl" />
        </a>
      </div>
    </div>
  </div>
  <!-- 主导航栏，fixed并且top-8（32px）紧贴广告栏下方 -->
  <header class="fixed top-12 left-0 w-full z-40 bg-white border-b border-gray-200 h-20">
    <div class="max-w-7xl mx-auto flex items-center h-20 px-4">
      <!-- 左侧 logo -->
      <div class="flex items-center">
        <img src="/images/logo/logo.png" alt="logo" class="h-15 w-20" />
      </div>
      <!-- 中间导航菜单，左侧加 margin-left:25px -->
      <nav class="flex items-center space-x-6 ml-[25px]">
        <Link
          href="#"
          class="text-[#000] font-bold"
        >ELENA MANDARIN</Link>
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
        
        <!-- Daily Practice 下拉菜单 -->
        <div class="relative group">
          <Link
            href="#"
            class="hover:text-[#009FE8] flex items-center"
            :class="url.startsWith('/practice') ? 'text-[#009FE8] font-bold' : 'text-gray-700'"
          >
            Daily Practice
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </Link>
          
          <!-- 下拉菜单内容 -->
          <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
            <div class="py-2">
              <Link
                v-for="level in ['HSK1', 'HSK2', 'HSK3', 'HSK4', 'HSK5', 'HSK6']"
                :key="level"
                :href="`/practice/${level.toLowerCase()}`"
                class="block px-4 py-2 text-gray-700 hover:bg-[#009FE8] hover:text-white transition-colors duration-200"
              >
                {{ level }}
              </Link>
            </div>
          </div>
        </div>

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
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

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

const url = computed(() => usePage().url)
</script>