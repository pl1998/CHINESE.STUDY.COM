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
          <section v-if="courses && courses.data" class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 py-16 px-4">
            <Link
              v-for="item in courses.data"
              :key="item.id"
              :href="`/hsk-lesson/${item.id}`"
              class="relative group border-2 border-white hover:border-[#009FE8] transition rounded block overflow-hidden mt-4"
            >
              <img 
                :src="item.cover" 
                :alt="item.name" 
                class="w-full h-56 object-cover rounded transition-transform duration-300 group-hover:scale-105" 
              />
              <!-- 遮罩层，z-10 -->
              <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-40 transition-all duration-300 z-10"></div>
              <!-- 文字层，z-20 -->
              <div class="absolute top-0 left-0 w-full bg-gradient-to-b from-black/80 to-transparent text-white text-center px-4 pt-4 pb-2 z-20">
                <div class="text-2xl font-bold mt-[40px]">{{ item.name }}</div>
                <div class="text-base font-semibold mt-2 truncate">{{ item.description }}</div>
              </div>
            </Link>
          </section>
          <div v-else class="text-center text-gray-400 py-8">No courses available at the moment</div>
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
