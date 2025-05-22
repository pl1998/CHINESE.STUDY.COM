<template>
<Layout :config="config">
  <div class="min-h-screen bg-white pt-[112px]">
    <!-- 导航栏 -->

    <!-- 顶部大图 -->
      <div class="w-full">
        <Banner imageSrc="/images/banner/about.jpg" alt="About Banner" />
      </div>

    <!-- 主体内容 -->
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row justify-end py-12 px-4 min-h-[320px]">
      <div class="w-full max-w-[480px] aspect-[1/1] flex items-center justify-center">
        <img :src="aboutSections[hovered !== null ? hovered : selected].img" alt="about-banner" class="max-w-full max-h-full object-contain transition-all duration-300 " />
      </div>
      <div class="flex-1 flex flex-col space-y-6 mt-8 md:mt-0">
        <div v-for="(section, idx) in aboutSections" :key="section.key"
          class="group flex items-center cursor-pointer px-6 py-5 rounded-2xl transition-all duration-200"
          :class="[
            (hovered === idx || selected === idx) ? 'bg-[#fffbe8] shadow-lg' : 'bg-white',
            'hover:bg-[#fffbe8] hover:shadow-lg'
          ]"
          @mouseenter="handleEnter(idx)" @mouseleave="handleLeave" @click="handleClick(idx)"
        >
          <span class="flex items-center justify-center mr-4">
            <svg v-if="hovered === idx || selected === idx" width="28" height="28" viewBox="0 0 28 28" fill="none"><circle cx="14" cy="14" r="14" fill="#F9B233"/><path d="M8 15l4 4 8-8" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <svg v-else width="28" height="28" viewBox="0 0 28 28" fill="none"><circle cx="14" cy="14" r="14" fill="#F3F4F6"/></svg>
          </span>
          <div>
            <div :class="['font-bold mb-1 text-lg transition-all', (hovered === idx || selected === idx) ? 'text-[#F9B233]' : 'text-gray-900']">
              {{ section.title }}
            </div>
            <div :class="['text-sm transition-all', (hovered === idx || selected === idx) ? 'font-semibold text-gray-900' : 'text-gray-700']">
              {{ section.desc }}
            </div>
          </div>
        </div>
      </div>
    </div>
   
  </div>
</Layout>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import Layout from '@/Layouts/App.vue'
import Banner from '@/Components/Banner.vue'

defineProps({
  config: {
    type: Object,
    required: true
  }
})
const aboutSections = [
  {
    key: 'curriculum',
    title: 'A clearly structured curriculum',
    desc: `Follow our guided study schedule and you'll always know what to do next. No more feeling lost!`,
    img: '/images/about/about_left.png',
  },
  {
    key: 'need',
    title: 'Everything you need',
    desc: `1,000+ lessons in 6+ comprehensive courses means you can go from true newbie to speaking and reading Chinese all in one place.`,
    img: '/images/about/about_left_1.png',
  },
  {
    key: 'results',
    title: 'See real results',
    desc: `With as little as 45 mins a day, we guarantee you'll see real progress on Yoyo Chinese. It's that good!`,
    img: '/images/about/about_left_2.png',
  },
  {
    key: 'lifetime',
    title: 'A lifetime of learning',
    desc: `With many years worth of study materials - including 15K+ vocab/flashcards, 10K+ quiz questions, and much more - you can easily review the Chinese you learn so you never lose it again!`,
    img: '/images/about/about_left.png',
  },
]

const hovered = ref(null)
const selected = ref(0)
let interval = null

function nextSection() {
  selected.value = (selected.value + 1) % aboutSections.length
}

function startAutoPlay() {
  if (interval) return
  interval = setInterval(() => {
    if (hovered.value === null) {
      nextSection()
    }
  }, 2500)
}
function stopAutoPlay() {
  if (interval) {
    clearInterval(interval)
    interval = null
  }
}

onMounted(() => {
  startAutoPlay()
})
onUnmounted(() => {
  stopAutoPlay()
})

function handleEnter(idx) {
  hovered.value = idx
  stopAutoPlay()
}
function handleLeave() {
  hovered.value = null
  startAutoPlay()
}
function handleClick(idx) {
  selected.value = idx
}
</script>
