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
    <!-- 底部内容 -->
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-start py-12 px-2 md:px-0 mt-8">
      <!-- 能力介绍 2x2 卡片 -->
      <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl shadow-md p-8 flex items-start space-x-4">
          <img src="/images/about/icon_speakiing@2x.webp" alt="Speaking" class="w-12 h-12 mt-1" />
          <div>
            <div class="font-bold text-base mb-1">Speaking</div>
            <ul class="text-gray-700 text-sm list-disc pl-4">
              <li>Pronounce all possible pinyin sounds and 4 tones with ease</li>
              <li>Go beyond simple introductions and handle basic topics</li>
            </ul>
          </div>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-8 flex items-start space-x-4">
          <img src="/images/about/icon_listening@2x.webp" alt="Listening" class="w-12 h-12 mt-1" />
          <div>
            <div class="font-bold text-lg mb-2">Listening</div>
            <ul class="text-gray-700 text-base list-disc pl-5 space-y-1">
              <li>Understand all essential everyday Chinese</li>
              <li>Get used to real-world Chinese as it's really spoken</li>
            </ul>
          </div>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-8 flex items-start space-x-4">
          <img src="/images/about/icon_reading@2x.webp" alt="Reading & Writing" class="w-12 h-12 mt-1" />
          <div>
            <div class="font-bold text-lg mb-2">Reading & Writing</div>
            <ul class="text-gray-700 text-base list-disc pl-5 space-y-1">
              <li>Recognize and spell any Chinese word using pinyin</li>
              <li>Type in Chinese using pinyin on your keyboard</li>
            </ul>
          </div>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-8 flex items-start space-x-4">
          <img src="/images/about/icon_grammar@2x.webp" alt="Grammar" class="w-12 h-12 mt-1" />
          <div>
            <div class="font-bold text-lg mb-2">Grammar</div>
            <ul class="text-gray-700 text-base list-disc pl-5 space-y-1">
              <li>Understand and utilize essential sentence structures</li>
              <li>Form your own simple sentences and express yourself</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- 统计项卡片 -->
      <div class="bg-white rounded-2xl shadow-md p-8 flex flex-col justify-start items-stretch md:ml-12 mt-8 md:mt-0 min-w-[220px]">
        <div class="flex items-center space-x-4 py-2">
          <img src="/images/about/icon_video@2x.webp" alt="Videos" class="w-10 h-10" />
          <div>
            <div class="font-bold text-3xl leading-none">73</div>
            <div class="text-gray-500 text-base font-medium">Videos</div>
          </div>
        </div>
        <div class="border-t my-2"></div>
        <div class="flex items-center space-x-4 py-2">
          <img src="/images/about/icon_flashcard@2x.webp" alt="Flashcards" class="w-10 h-10" />
          <div>
            <div class="font-bold text-3xl leading-none">646</div>
            <div class="text-gray-500 text-base font-medium">Flashcards</div>
          </div>
        </div>
        <div class="border-t my-2"></div>
        <div class="flex items-center space-x-4 py-2">
          <img src="/images/about/icon_audio@2x.webp" alt="Audios" class="w-10 h-10" />
          <div>
            <div class="font-bold text-3xl leading-none">61</div>
            <div class="text-gray-500 text-base font-medium">Audios</div>
          </div>
        </div>
        <div class="border-t my-2"></div>
        <div class="flex items-center space-x-4 py-2">
          <img src="/images/about/icon_quiz@2x.webp" alt="Quiz Questions" class="w-10 h-10" />
          <div>
            <div class="font-bold text-3xl leading-none">730</div>
            <div class="text-gray-500 text-base font-medium">Quiz Questions</div>
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
