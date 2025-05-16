<template>
<Layout :config="config">
  <div class="bg-white pt-[112px]">
    <div>
       <!-- 顶部大图 -->
       <div class="w-full">
          <Banner imageSrc="/images/banner/lesson.jpg" alt="Lessons Banner" />
        </div>

      <div class="max-w-6xl mx-auto w-full px-4 pb-8">
           <!-- 面包屑导航 -->
           <Breadcrumb :current="'1V1 LESSON'" />
          
    <!-- 课程内容区域 -->
    <section class="max-w-7xl mx-auto py-16 px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10"> 
        <div class="bg-white rounded-2xl shadow-lg flex flex-col bg-[#F7FAFC]" v-for="course in courses.data" :key="course.id">
          <img :src="course.cover" :alt="course.title" class="w-full h-[180px] object-cover" />
          <div class="flex-1 flex flex-col p-4">
            <h3 class="text-[2rem] font-bold text-[#1a2233] mb-4 text-left">HSK 1-6</h3>
            <p class="text-[#1a2233] text-base mb-8 text-left leading-relaxed">
             {{ course.description }}
            </p>
           <div class="flex justify-center w-full mt-auto">
            <Link :href="`/hsk-lesson/${course.id}`" class="block w-full mt-auto w-40 bg-[#1756c2] hover:bg-[#003a8c] text-white font-semibold rounded-lg py-3  tracking-widest text-center transition uppercase">LEARN MORE</Link>
           </div>
          </div>
        </div>
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

const { config } = defineProps({
  config: {
    type: Object,
    required: true
  }
})

const { courses } = usePage().props
</script>
