<template>
  <div class="min-h-screen bg-white">
    <!-- 导航栏复用 -->
    <Navbar />

<div class="pt-[88px]">
  <div class="max-w-6xl mx-auto w-full px-4 py-8">
       <!-- 面包屑导航 -->
       <div class="w-full bg-[#f7f7f7] py-2 px-4 text-sm text-gray-600">
        Home &gt;&gt; <span class="text-[#009FE8]">1V1 LESSON</span>
      </div>
      <!-- 课程内容区域 -->
      <section class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 py-8 px-4">
        <!-- HSK 1-6 -->
        <Link href="/hsk-lesson" class="relative group border-2 border-white hover:border-[#009FE8] transition rounded block">
          <img src="/images/lessons/lessons_a.jpg" alt="HSK 1-6" class="w-full h-56 object-cover rounded" />
          <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-white text-center px-4">
            <div class="text-2xl font-bold mb-2">HSK 1-6</div>
            <div class="text-base font-semibold">MASTER THE HSK<br />WITH STRUCTURED LESSONS</div>
          </div>
        </Link>
        <!-- survival chinese -->
        <Link href="/survival-chinese" class="relative group border-2 border-white hover:border-[#009FE8] transition rounded block">
          <img src="/images/lessons/lessons_b.jpg" alt="survival chinese" class="w-full h-56 object-cover rounded" />
          <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-white text-center px-4">
            <div class="text-2xl font-bold mb-2">survival chinese</div>
            <div class="text-base font-semibold">PRACTICAL CHINESE<br />FOR EVERYDAY LIFE</div>
          </div>
        </Link>

        <!-- Fun Chinese Debate Topics -->
        <Link href="/debate-topics" class="relative group border-2 border-white hover:border-[#009FE8] transition rounded block">
          <img src="/images/lessons/lessons_c.jpg" alt="Fun Chinese Debate Topics" class="w-full h-56 object-cover rounded" />
          <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-white text-center px-4">
            <div class="text-2xl font-bold mb-2">Fun Chinese Debate Topics</div>
            <div class="text-base font-semibold">EXCEL IN PROFESSIONAL CHINESE COMMUNICATION</div>
          </div>
        </Link>
        <!-- conversational chinese -->
        <Link href="/conversational-chinese" class="relative group border-2 border-white hover:border-[#009FE8] transition rounded block">
          <img src="/images/lessons/lessons_d.jpg" alt="conversational chinese" class="w-full h-56 object-cover rounded" />
          <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-white text-center px-4">
            <div class="text-2xl font-bold mb-2">conversational chinese</div>
            <div class="text-base font-semibold">Learn Mandarin Through Real Conversations</div>
          </div>
        </Link>
      </section>
</div>
</div>

    <!-- 页脚复用 -->
    <Footer />
  </div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue'
import Footer from '../components/Footer.vue'
import { Link } from '@inertiajs/vue3'
</script>
