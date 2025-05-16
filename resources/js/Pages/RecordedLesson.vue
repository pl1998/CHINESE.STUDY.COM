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
        
        <section  class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 py-16 px-4">
          <Link
            href="#"
            class="relative group border-2 border-white hover:border-[#009FE8] transition rounded block overflow-hidden mt-4"
          >
            <img 
            src="/images/lesson_book.png" 
            alt="course" 
              class="w-full h-56 object-cover rounded transition-transform duration-300 group-hover:scale-105" 
            />
            <!-- 遮罩层，z-10 -->
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-40 transition-all duration-300 z-10"></div>
            <!-- 文字层，z-20 -->
            <div class="absolute top-0 left-0 w-full bg-gradient-to-b from-black/80 to-transparent text-white text-center px-4 pt-4 pb-2 z-20">
              <div class="text-2xl font-bold mt-[50px]">course</div>
              <div class="text-base font-semibold mt-2 truncate">course description</div>
            </div>
          </Link>
        </section>


        <!-- 分页 -->
        <div class="flex justify-center items-center gap-2 mt-8">
          <button class="border px-2 py-1 text-xs rounded bg-gray-100 text-gray-500" disabled>Home</button>
          <button class="border px-2 py-1 text-xs rounded bg-gray-100 text-gray-500" disabled>Previous</button>
          <span class="border px-2 py-1 text-xs rounded bg-[#f7f7f7] text-gray-700">1</span>
          <button class="border px-2 py-1 text-xs rounded bg-gray-100 text-gray-500" disabled>Next</button>
          <button class="border px-2 py-1 text-xs rounded bg-gray-100 text-gray-500" disabled>End</button>
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
const { lesson } = usePage().props

defineProps({
  config: {
    type: Object,
    required: true
  }
})
</script>
