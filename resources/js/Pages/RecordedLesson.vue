<template>
  <div class="bg-white">
    <Navbar />
    <div class="pt-[88px]">
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
        <div class="flex flex-wrap gap-8">
          <div class="w-64 border rounded bg-white shadow-sm p-2 flex flex-col items-center">
            <img src="/images/lesson_book.png" alt="course" class="w-full h-40 object-cover rounded mb-2" />
            <div class="text-center text-sm text-gray-700 mt-2">course</div>
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

    <!-- 页脚 -->
<Footer/>
  </div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue'
import Footer from '../components/Footer.vue'
</script>
