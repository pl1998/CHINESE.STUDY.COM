<template>
<Layout :config="config">
  <div class="pt-[88px]">
    <div class="bg-white">
      <!-- Brand 图 -->
      <div class="w-full">
        <img src="/images/daily_pratice/brander.jpg" alt="Brander" class="w-full h-56 object-cover" />
      </div>

      <!-- 面包屑导航 -->
      <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-8 px-4">
      <div class="w-full bg-[#f7f7f7] py-2 px-4 text-sm text-gray-600">
      Home &gt;&gt; <span class="text-[#009FE8]">1Daily Pratice</span>
    </div>
  </div>
      <!-- 产品图和播放按钮 -->
      <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-8 py-8 px-4">
        <div class="flex-1 flex flex-col items-center">
          <img
            src="/images/daily_pratice/product.jpg"
            alt="Product"
            class="w-80 h-48 object-cover rounded shadow cursor-pointer"
            @click="toggleAudio"
          />
          <!-- 音频播放器（隐藏） -->
          <audio ref="audioRef" :src="audioSrc" @ended="isPlaying = false"></audio>
        </div>
      </div>
      <!-- 分页组件 -->
      <div class="max-w-4xl mx-auto flex justify-center items-center gap-2 py-8">
        <button class="border px-3 py-1 rounded hover:bg-gray-100">Home</button>
        <button class="border px-3 py-1 rounded hover:bg-gray-100">Previous</button>
        <button class="border px-3 py-1 rounded bg-[#009FE8] text-white">1</button>
        <button class="border px-3 py-1 rounded hover:bg-gray-100">Next</button>
        <button class="border px-3 py-1 rounded hover:bg-gray-100">End</button>
      </div>
    </div>
  </div>
</Layout>
</template>

<script setup>
import Layout from '@/Layouts/App.vue'
defineProps({
  config: {
    type: Object,
    required: true
  }
})
import { ref } from 'vue'

const audioRef = ref(null)
const isPlaying = ref(false)
const audioSrc = '/audio/product.mp3' // 请将你的 mp3 文件放在 public/audio/product.mp3

function toggleAudio() {
  if (!audioRef.value) return
  if (isPlaying.value) {
    audioRef.value.pause()
    isPlaying.value = false
  } else {
    audioRef.value.play()
    isPlaying.value = true
  }
}
</script>
