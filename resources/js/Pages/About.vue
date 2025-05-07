<template>
  <div class="min-h-screen bg-white">
    <!-- 导航栏 -->
    <Navbar />

    <!-- 顶部大图 -->
    <div class="w-full h-[260px] md:h-[320px] bg-gray-200">
      <img
        src="/images/about/about_banner.jpg"
        alt="about-banner"
        class="w-full h-full object-cover"
      />
    </div>

    <!-- 主体内容 -->
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row justify-end py-12 px-4 min-h-[320px]">
      <div class="flex-1"></div>
      <div class="flex-1 flex flex-col space-y-8">
        <div>
          <div class="font-bold text-lg mb-1">A clearly structured curriculum</div>
          <div class="text-gray-700 text-sm">
            Follow our guided study schedule and you'll always know what to do next. No more feeling lost!
          </div>
        </div>
        <div>
          <div class="font-bold text-lg mb-1">Everything you need</div>
          <div class="text-gray-700 text-sm">
            1,000+ lessons in 6 comprehensive courses means you can go from true newbie to speaking and reading Chinese all in one place.
          </div>
        </div>
        <div>
          <div class="font-bold text-lg mb-1">See real results</div>
          <div class="text-gray-700 text-sm">
            With as little as 40 mins a day, we guarantee you'll see real progress on Yoyo Chinese. It's that good!
          </div>
        </div>
        <div>
          <div class="font-bold text-lg mb-1">A lifetime of learning</div>
          <div class="text-gray-700 text-sm">
            With many years worth of study materials - including 15K+ vocab/flashcards, 10K+ quiz questions, and much more - you can easily review the Chinese you learn so you never lose it again!
          </div>
        </div>
      </div>
    </div>

    <!-- 页脚 -->
    <Footer />
  </div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue'
import Footer from '../components/Footer.vue'
</script> 