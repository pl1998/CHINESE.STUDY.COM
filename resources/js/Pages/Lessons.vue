<template>
<Layout :config="config">
  <div class="bg-white pt-[112px]">
    <div>
       <!-- 顶部大图 -->
       <div class="w-full">
          <Banner imageSrc="/images/banner/1V1_LESSON.jpg" alt="Lessons Banner" />
        </div>

      <div class="max-w-6xl mx-auto w-full px-4 pb-8">
           <!-- 面包屑导航 -->
           <Breadcrumb :current="'1V1 LESSON'" />
          
    <!-- 课程内容区域 -->
    <section class="max-w-7xl mx-auto py-16 px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10"> 
        <!-- 骨架屏 -->
        <template v-if="loading">
          <div v-for="n in 6" :key="n" class="bg-white rounded-2xl shadow-lg flex flex-col bg-[#F7FAFC]">
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
          <div class="bg-white rounded-2xl shadow-lg flex flex-col bg-[#F7FAFC]" v-for="course in courses.data" :key="course.id">
            <img :src="course.cover" :alt="course.name" class="w-full h-[180px] object-cover" />
            <div class="flex-1 flex flex-col p-4">
              <h4 class="text-[1.2rem] font-bold text-[#1a2233] mb-4 text-left">{{ course.name }}</h4>
              <p class="text-[#1a2233] text-base mb-8 text-left leading-relaxed">
               {{ course.description }}
              </p>
             <div class="flex justify-center w-full mt-auto">
              <Link :href="`/hsk-lesson/${course.id}`" class="block w-full mt-auto w-40 bg-[#1756c2] hover:bg-[#003a8c] text-white font-semibold rounded-lg py-3  tracking-widest text-center transition uppercase">LEARN MORE</Link>
             </div>
            </div>
          </div>
        </template>
      </div>
    </section>
    <!-- 分页 -->
    <div class="flex justify-center gap-2 py-8">
            <template v-for="page in courses.links" :key="page.label">
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
      </div>
</Layout>
</template>
<script setup>
import Layout from '@/Layouts/App.vue'
import { Link, usePage } from '@inertiajs/vue3'
import Banner from '@/Components/Banner.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue'
import { ref, onMounted } from 'vue'

const { config } = defineProps({
  config: {
    type: Object,
    required: true
  }
})

const { courses } = usePage().props
const loading = ref(true)

onMounted(() => {
  // 模拟加载延迟
  setTimeout(() => {
    loading.value = false
  }, 500)
})
</script>
