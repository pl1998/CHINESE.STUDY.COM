<template>
  <Layout :config="config">
    <div class="pt-[88px]">
      <div class="bg-white">
        <!-- Brand 图 -->
        <div class="w-full">
          <img src="/images/banner/pratice.jpg" alt="Brander" class="w-full h-56 object-cover" />
        </div>

        <!-- 面包屑导航 -->
        <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-8 px-4">
          <div class="w-full bg-[#f7f7f7] py-2 px-4 text-sm text-gray-600">
            Home &gt;&gt; <span class="text-[#009FE8]">1Daily Practice</span>
          </div>
        </div>

        <!-- 课程实战卡片 -->
        <div class="max-w-4xl mx-auto py-8 px-4">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
              v-for="item in practices"
              :key="item.id"
              class="flex flex-col items-center"
            >
              <img
                :src="item.cover"
                alt="cover"
                :class="[
                  'w-80 h-48 object-cover rounded shadow cursor-pointer transition-all duration-200',
                  playingId === item.id ? 'ring-4 ring-blue-400 scale-105' : ''
                ]"
                @click="playAudio(item.id)"
              />
              <div class="mt-2 font-bold text-center">{{ item.name }}</div>
              <!-- <a v-if="item.link" :href="item.link" target="_blank" class="text-blue-500">课程链接</a> -->
              <audio
                v-if="item.audio"
                :ref="el => {
                  if (el) {
                    audioRefs[item.id] = el
                  } else {
                    delete audioRefs[item.id]
                  }
                }"
                :src="item.audio"
                @ended="playingId = null"
                style="display:none"
              ></audio>
            </div>
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

const playAudio = (id) => {
  // 暂停其他音频
  Object.keys(audioRefs).forEach(key => {
    if (audioRefs[key] && key != id) {
      audioRefs[key].pause()
      audioRefs[key].currentTime = 0
    }
  })
  const audio = audioRefs[id]
  if (!audio) return
  if (playingId.value === id) {
    audio.pause()
    playingId.value = null
  } else {
    audio.play()
    playingId.value = id
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