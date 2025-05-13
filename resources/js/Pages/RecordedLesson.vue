<template>
<Layout :config="config">
  <div class="bg-white pt-[112px]">

       <!-- Brand 图 -->
       <div class="w-full">
          <Banner imageSrc="/images/banner/recorded_lesson.jpg" alt="Recorded Lesson Banner" />
        </div>
      <!-- 课程筛选和列表 -->
      <div class="max-w-6xl mx-auto w-full px-4 py-8">
             <!-- 面包屑 -->
      <div class="w-full bg-[#f7f7f7] py-2 px-4 text-sm text-gray-600">
        Home &gt;&gt; <span class="text-[#009FE8]">Recorded Lesson</span>
      </div>
        <!-- 筛选标签 -->
        <div class="mb-4 mt-2">
          <button class="border px-4 py-1 rounded bg-white text-gray-700 text-sm">all</button>
          <!-- 可添加更多筛选按钮 -->
        </div>
        <!-- 课程卡片 -->
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 py-8 px-4">
          <div class="relative group border-2 border-white hover:border-[#009FE8] transition rounded block overflow-hidden">
            <img 
              src="/images/lesson_book.png" 
              alt="course" 
              class="w-full h-56 object-cover rounded transition-transform duration-300 group-hover:scale-105" 
            />
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-40 flex flex-col items-center justify-center text-white text-center px-4 transition-all duration-300">
              <div class="text-2xl font-bold mb-2">course</div>
            </div>
          </div>
          <!-- 你可以复制上面div，渲染更多课程 -->
        </div>

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

const { lesson } = usePage().props

defineProps({
  config: {
    type: Object,
    required: true
  }
})
</script>
