<template>
  <div class="min-h-screen bg-white">
    <!-- 导航栏 -->
    <Navbar />

    <!-- 课程介绍主区域 -->
    <div class="w-full bg-[#eaf2f3] py-12">
      <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-8 px-4">
        <!-- 左侧标题和图片 -->
        <div class="flex-1 flex flex-col justify-center">
          <div class="text-[#6b7a8f] text-xs mb-2 tracking-widest">YOUR PATH TO FLUENCY</div>
          <div class="text-[56px] leading-tight font-bold mb-6 text-[#2d3a4a]">
            HSK 1-6<br>Lessons
          </div>
          <div class="w-full h-64 bg-white flex items-center justify-center border border-gray-200 rounded mb-6">
            <img src="/images/lesson_book.png" alt="hsk lesson" class="w-auto h-full object-contain rounded-lg" />
          </div>
          <button class="bg-[#6ec1e4] text-white px-8 py-2 rounded font-semibold hover:bg-[#009FE8] transition text-lg shadow-md">book now</button>
        </div>
        <!-- 右侧介绍 -->
        <div class="flex-1 flex flex-col justify-center">
          <div class="text-[#2d3a4a] font-semibold mb-2 text-base">Living In China</div>
          <div class="text-gray-700 text-sm leading-relaxed">
            The HSK (Hanyu Shuiping Kaoshi) Chinese Proficiency Materials are a comprehensive and well-structured resource designed to help learners of all levels master the Chinese language. Developed by Hanban, the official Chinese Language Council International, these materials align with the HSK exam, which is the most widely recognized Chinese language proficiency test globally.<br><br>
            <b>1. Structured Learning Path</b><br>
            The six-level system (HSK 1-6) provides a clear, step-by-step progression for learners of all levels.<br>
            <b>2. Real-Life Language Skills</b><br>
            Focused on practical vocabulary and grammar, the materials prepare learners for everyday communication.<br>
            <b>3. Exam-Oriented Preparation</b><br>
            Tailored to the HSK exam format, they include practice tests and strategies for success.<br>
            <b>4. Comprehensive Resources</b><br>
            Covering listening, speaking, reading, and writing, they ensure balanced language development.
          </div>
        </div>
      </div>
    </div>

    <!-- FAQ 区域 -->
    <div class="w-full bg-cover bg-center py-16" style="background-image: url('/images/lesson_bg.png');">
      <div class="max-w-6xl mx-auto px-4">
        <div class="text-center text-white text-lg mb-2 tracking-widest">FAQ</div>
        <div class="text-center text-white text-5xl font-bold mb-12 tracking-wider">QUESTIONS</div>
        <div class="grid md:grid-cols-3 gap-8 text-white">
          <div>
            <div class="font-bold mb-2 text-base">WHAT IS THE HSK, AND WHY IS IT IMPORTANT?</div>
            <div class="text-sm">
              The HSK (Hanyu Shuiping Kaoshi) is the official Chinese proficiency test recognized internationally. It certifies your Chinese language skills, which can be beneficial for academic, professional, and personal pursuits.
            </div>
          </div>
          <div>
            <div class="font-bold mb-2 text-base">HOW LONG DOES IT TAKE TO PREPARE FOR AN HSK EXAM?</div>
            <div class="text-sm">
              The time required depends on your starting level and how much time you can dedicate to study. On average, students can prepare for each HSK level within 3-6 months with regular lessons and practice.
            </div>
          </div>
          <div>
            <div class="font-bold mb-2 text-base">HOW ARE YOUR LESSONS STRUCTURED FOR DIFFERENT HSK LEVELS?</div>
            <div class="text-sm">
              Our lessons are tailored to each HSK level, from beginner (HSK 1) to advanced (HSK 6). We focus on building the necessary skills for each level, including listening, reading, writing, and speaking, with practice tests and real-world applications.
            </div>
          </div>
          <div>
            <div class="font-bold mb-2 text-base">DO YOU PROVIDE HSK EXAM PRACTICE TESTS?</div>
            <div class="text-sm">
              Yes, we provide mock exams and practice tests as part of our preparation process to help you become familiar with the exam format and timing.
            </div>
          </div>
          <div>
            <div class="font-bold mb-2 text-base">WHAT CAN I EXPECT TO ACHIEVE AFTER COMPLETING EACH HSK LEVEL?</div>
            <div class="text-sm">
              After completing each level, you will have mastered the corresponding vocabulary, grammar, and language skills, enabling you to pass the HSK exam and communicate effectively at that level.
            </div>
          </div>
          <div>
            <div class="font-bold mb-2 text-base">CAN I START AT ANY HSK LEVEL, OR DO I NEED TO START FROM LEVEL 1?</div>
            <div class="text-sm">
              You can start at any level that matches your current proficiency. We offer an initial assessment to determine the best starting point for you.
            </div>
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