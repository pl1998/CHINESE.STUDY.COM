<template>
  <Layout :config="config">
      <div class="bg-white pt-[112px]">
        <!-- Brand 图 -->
        <div class="w-full">
          <Banner imageSrc="/images/banner/pratice.jpg" alt="Practice Banner" />
        </div>

     
        <div class="max-w-6xl mx-auto w-full px-4 pb-8">
          <!-- 面包屑 -->
          <Breadcrumb :current="'Daily Practice'" />

 <!-- 课程搜索-->
<div class="bg-white p-6 rounded-lg shadow mb-8">
  <div class="flex flex-wrap items-center gap-4">
    <!-- 搜索框 -->
    <input
      v-model="search"
      @keyup.enter="applyFilters"
      type="text"
      placeholder="Search..."
      class="flex-1 border rounded px-4 py-2"
    />

    <!-- 难度筛选 -->
    <select v-model="level" class="border rounded px-4 py-2 min-w-[120px]">
      <option value="0">All Levels</option>
      <option value="1">Beginner</option>
      <option value="2">Intermediate</option>
      <option value="3">Advanced</option>
    </select>

    <!-- HSK 多选 -->
    <!-- <select v-model="hsk" class="border rounded px-4 py-2 min-w-[120px]">
      <option value="">All HSK</option>
      <option value="HSK1">HSK1</option>
      <option value="HSK2">HSK2</option>
      <option value="HSK3">HSK3</option>
      <option value="HSK4">HSK4</option>
      <option value="HSK5">HSK5</option>
      <option value="HSK6">HSK6</option>
    </select> -->

    <!-- 进度筛选 -->
    <!-- <select v-model="progress" class="border rounded px-4 py-2 min-w-[180px]">
      <option value="">All</option>
      <option value="my">My Progress (member only)</option>
    </select> -->

    <!-- 按钮 -->
    <button @click="applyFilters" class="border border-[#e53958] text-[#e53958] px-4 py-2 rounded hover:bg-[#e53958] hover:text-white transition">Apply filters</button>
    <button @click="clearFilters" class="border border-[#e53958] text-[#e53958] px-4 py-2 rounded hover:bg-[#e53958] hover:text-white transition">Clear filters</button>
  </div>
</div>

        <!-- 课程实战卡片 -->
        <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 py-8 px-4">
          <Link
            v-for="item in practices"
            :key="item.id"
            :href="`/practice-detail/${item.id}`"
            class="bg-white rounded border border-gray-300 shadow-lg hover:shadow-2xl overflow-hidden transition cursor-pointer"
            @click="playAudio(item.id)"
          >
            <!-- 顶部标签 -->
            <div class="flex items-center px-4 pt-4 pb-2">
              <svg class="w-4 h-4 text-[#2196f3] mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M6 2a1 1 0 00-1 1v14l5-3 5 3V3a1 1 0 00-1-1H6z"/>
              </svg>
              <span class="text-[#2196f3] text-sm font-medium">
                {{ item.level_label }}, Story
              </span>
            </div>
            <!-- 封面图 -->
            <img
              :src="item.cover"
              alt="cover"
              class="w-full h-40 object-cover"
            />
            <!-- 标题和描述 -->
            <div class="px-4 py-3">
              <div class="font-semibold text-base text-gray-800 mb-1">{{ item.name }}</div>
              <div class="text-gray-600 text-sm">{{ item.zh_name }}</div>
            </div>
          </Link>
        </div>

        <!-- 分页组件 -->
        <div class="max-w-4xl mx-auto flex justify-center items-center gap-2 py-8">
          <button
            class="border px-3 py-1 rounded hover:bg-gray-100"
            :disabled="pagination.current_page === 1"
            @click="goToPage(1)"
          >Home</button>
          <button
            class="border px-3 py-1 rounded hover:bg-gray-100"
            :disabled="pagination.current_page === 1"
            @click="goToPage(pagination.current_page - 1)"
          >Previous</button>
          <button
            v-for="page in pageNumbers"
            :key="page"
            :class="['border px-3 py-1 rounded', { 'bg-[#009FE8] text-white': page === pagination.current_page }]"
            @click="goToPage(page)"
          >{{ page }}</button>
          <button
            class="border px-3 py-1 rounded hover:bg-gray-100"
            :disabled="pagination.current_page === pagination.last_page"
            @click="goToPage(pagination.current_page + 1)"
          >Next</button>
          <button
            class="border px-3 py-1 rounded hover:bg-gray-100"
            :disabled="pagination.current_page === pagination.last_page"
            @click="goToPage(pagination.last_page)"
          >End</button>
        </div>

        <div v-if="courses.length" class="mt-6">
          <div v-for="course in courses" :key="course.id" class="p-4 border-b">
            <div class="font-bold">{{ course.title }}</div>
            <div class="text-sm text-gray-500">{{ course.description }}</div>
          </div>
        </div>
</div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from '@/Layouts/App.vue'
import { ref, onMounted, computed, reactive } from 'vue'
import axios from 'axios'
import { Link, usePage } from '@inertiajs/vue3'
import Banner from '@/Components/Banner.vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faVolumeUp } from '@fortawesome/free-solid-svg-icons'
import Breadcrumb from '@/Components/Breadcrumb.vue'

library.add(faVolumeUp)
const { level_label } = usePage().props
defineProps({
  config: {
    type: Object,
    required: true
  }
})

const practices = ref([])
const pagination = ref({
  current_page: 1,
  last_page: 1,
  per_page: 6,
  total: 0
})
const audioRefs = reactive({})
const playingId = ref(null)

const search = ref('')
const hsk = ref('')
const level = ref('')
const progress = ref('')

const courses = ref([]) // 搜索结果

const fetchPractices = async (page = 1) => {
  const res = await axios.get(`/api/course-practices?page=${page}&per_page=${pagination.value.per_page}&level_label=${level_label}`)

  practices.value = res.data.data
  pagination.value = {
    current_page: res.data.current_page,
    last_page: res.data.last_page,
    per_page: res.data.per_page,
    total: res.data.total
  }
}

onMounted(() => fetchPractices())

const goToPage = (page) => {
  if (page < 1 || page > pagination.value.last_page) return
  fetchPractices(page)
}

const handleAudioError = (error) => {
  console.error('Audio loading error:', error)
  playingId.value = null
}

const playAudio = async (id) => {
  try {
    // 暂停其他音频
    Object.keys(audioRefs).forEach(key => {
      if (audioRefs[key] && key != id) {
        audioRefs[key].pause()
        audioRefs[key].currentTime = 0
      }
    })
    
    const audio = audioRefs[id]
    
    if (!audio) {
      console.error('Audio element not found')
      return
    }

    // 确保音频已加载
    if (audio.readyState === 0) {
      await new Promise((resolve, reject) => {
        audio.addEventListener('canplaythrough', resolve, { once: true })
        audio.addEventListener('error', reject, { once: true })
        audio.load()
      })
    }
    
    if (playingId.value === id) {
      audio.pause()
      playingId.value = null
    } else {
      await audio.play()
      playingId.value = id
    }
  } catch (error) {
    console.error('Error playing audio:', error)
    playingId.value = null
  }
}

// 只显示部分页码（如 1 ... 4 5 6 ... 10）
const pageNumbers = computed(() => {
  const total = pagination.value.last_page
  const current = pagination.value.current_page
  if (total <= 7) return Array.from({ length: total }, (_, i) => i + 1)
  const pages = []
  if (current > 3) pages.push(1)
  if (current > 4) pages.push('...')
  for (let i = Math.max(1, current - 1); i <= Math.min(total, current + 1); i++) {
    pages.push(i)
  }
  if (current < total - 3) pages.push('...')
  if (current < total - 2) pages.push(total)
  return pages
})

const applyFilters = async () => {
  // 这里假设你的API为 /api/courses/search
  const res= await axios.get('/api/course-practices', {
    params: {
      search: search.value,
      level: level.value,
      hsk: hsk.value,
      progress: progress.value,
      level_label: level.value,
    }
  })
  practices.value = res.data.data
  pagination.value = {
    current_page: res.data.current_page,
    last_page: res.data.last_page,
    per_page: res.data.per_page,
    total: res.data.total
  }
}

const clearFilters = () => {
  search.value = ''
  level.value = ''
  hsk.value = ''
  progress.value = ''
  applyFilters()
}
</script>