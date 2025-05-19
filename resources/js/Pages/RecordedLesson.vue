<template>
<Layout :config="config">
  <div class="bg-white pt-[112px]">

       <!-- Brand 图 -->
       <div class="w-full">
          <Banner imageSrc="/images/banner/recorded_lesson.jpg" alt="Recorded Lesson Banner" />
        </div>
      <!-- 课程筛选和列表 -->
      <div class="max-w-6xl mx-auto w-full px-4 pb-8">
             <!-- 面包屑 -->
             <Breadcrumb :current="'Recorded Lesson'" />
        <!-- 筛选标签 -->
        <div class="mb-4 mt-2">
          <button class="border px-4 py-1 rounded bg-white text-gray-700 text-sm">all</button>
          <!-- 可添加更多筛选按钮 -->
        </div>
        <!-- 课程卡片 -->
        
        <section class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 py-16 px-4">
          <!-- 骨架屏 -->
          <template v-if="loading">
            <div v-for="n in 9" :key="n" class="bg-white rounded-2xl shadow-lg flex flex-col bg-[#F7FAFC]">
              <div class="animate-pulse">
                <div class="bg-gray-200 h-[180px] w-full"></div>
                <div class="p-4">
                  <div class="h-6 bg-gray-200 rounded w-3/4 mb-4"></div>
                  <div class="space-y-3">
                    <div class="h-4 bg-gray-200 rounded w-full"></div>
                    <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    <div class="h-4 bg-gray-200 rounded w-4/6"></div>
                  </div>
                  <div class="mt-8">
                    <div class="h-10 bg-gray-200 rounded w-40 mx-auto"></div>
                  </div>
                </div>
              </div>
            </div>
          </template>

          <!-- 实际内容 -->
          <template v-else>
            <Link  :href="`${lesson.link}`" v-for="lesson in lessons.data" :key="lesson.id" class="bg-white rounded-2xl shadow-lg flex flex-col bg-[#F7FAFC]" target="_blank">
              <img 
                :src="lesson.cover" 
                :alt="lesson.name" 
                class="w-full h-[180px] object-cover" 
              />
              <div class="flex-1 flex flex-col p-4">
                <h4 class="text-[1.2rem] font-bold text-[#1a2233] mb-4 text-left">{{ lesson.name }}</h4>
                <p class="text-[#1a2233] text-base mb-8 text-left leading-relaxed">
                  {{ lesson.description }}
                </p>
              </div>
            </Link>
          </template>
        </section>

        <!-- 分页 -->
        <div class="flex justify-center gap-2 py-8">
          <template v-for="page in lessons.links" :key="page.label">
            <Link
              v-if="page.url"
              :href="page.url"
              v-html="page.label"
              :class="['px-3 py-1 rounded', { 'bg-[#009FE8] text-white': page.active, 'text-gray-500': !page.active }]"
              preserve-scroll
            />
            <span
              v-else
              v-html="page.label"
              class="px-3 py-1 rounded text-gray-300 cursor-not-allowed"
            />
          </template>
        </div>
      </div>
    </div>

</Layout>
</template>

<script setup>
import Layout from '@/Layouts/App.vue'
import Banner from '@/Components/Banner.vue'
import { usePage } from '@inertiajs/vue3'
import Breadcrumb from '@/Components/Breadcrumb.vue'
import { ref, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  config: {
    type: Object,
    required: true
  },
  lessons: {
    type: Object,
    required: true
  }
})

const loading = ref(true)

onMounted(() => {
  // 模拟加载延迟
  setTimeout(() => {
    loading.value = false
  }, 500)
})
</script>
