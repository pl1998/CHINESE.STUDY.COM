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
        <!-- 课程实战卡片 -->
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 py-8 px-4">
          <div
            v-for="item in practices"
            :key="item.id"
            class="relative group border-2 border-white hover:border-[#009FE8] transition rounded block cursor-pointer overflow-hidden"
            @click="playAudio(item.id)"
          >
            <img
              :src="item.cover"
              alt="cover"
              class="w-full h-56 object-cover rounded transition-transform duration-300 group-hover:scale-105"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex flex-col items-center  text-white text-center px-4 pb-4">
              <div class="text-2xl font-bold mt-[100px]">{{ item.name }}</div>
            </div>
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-40 flex flex-col items-center justify-center text-white text-center px-4 transition-all duration-300">
              <div v-if="playingId === item.id" class="text-sm flex items-center">
                <font-awesome-icon :icon="['fas', 'volume-up']" class="mr-1" />
                正在播放...
              </div>
              <div v-if="item.description" class="text-base font-semibold opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                {{ item.description }}
              </div>
            </div>
            <audio
              v-if="item.audio"
              :ref="el => { if (el) { audioRefs[item.id] = el } else { delete audioRefs[item.id] } }"
              :src="item.audio"
              @ended="playingId = null"
              @error="handleAudioError"
              preload="auto"
              style="display:none"
            ></audio>
          </div>
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
</div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from '@/Layouts/App.vue'
import { ref, onMounted, computed, reactive } from 'vue'
import axios from 'axios'
import Banner from '@/Components/Banner.vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faVolumeUp } from '@fortawesome/free-solid-svg-icons'
import Breadcrumb from '@/Components/Breadcrumb.vue'

library.add(faVolumeUp)

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

const fetchPractices = async (page = 1) => {
  const res = await axios.get(`/api/course-practices?page=${page}&per_page=${pagination.value.per_page}`)

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
</script>