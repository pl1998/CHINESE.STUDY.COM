<template>
  <div class="min-h-screen bg-white">
    <!-- 导航栏 -->
    <Navbar />

    <!-- 联系方式标题 -->
    <div class="max-w-4xl mx-auto mt-8 mb-4 text-center">
      <h2 class="text-2xl font-semibold text-[#009FE8] mb-2">•Contact us•</h2>
    </div>

    <!-- 三个联系方式卡片 -->
    <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 px-4">
      <!-- Whatsapp -->
      <div class="bg-white border rounded shadow-sm flex flex-col items-center py-8">
        <div class="bg-[#009FE8] rounded-full w-16 h-16 flex items-center justify-center mb-3">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M6.62 10.79a15.053 15.053 0 0 0 6.59 6.59l2.2-2.2a1.003 1.003 0 0 1 1.11-.21c1.12.45 2.33.69 3.48.69a1 1 0 0 1 1 1v3.5a1 1 0 0 1-1 1C6.48 22 2 17.52 2 12.5a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.15.24 2.36.69 3.48a1.003 1.003 0 0 1-.21 1.11l-2.2 2.2z"/>
          </svg>
        </div>
        <div class="font-semibold text-lg">Whatsapp</div>
        <div class="text-gray-500 text-sm mt-1">+86 13530041224</div>
      </div>
      <!-- Email -->
      <div class="bg-white border rounded shadow-sm flex flex-col items-center py-8">
        <div class="bg-[#009FE8] rounded-full w-16 h-16 flex items-center justify-center mb-3">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M4 4h16v16H4z" fill="none"/>
            <path d="M22 6l-10 7L2 6" />
          </svg>
        </div>
        <div class="font-semibold text-lg">Service email</div>
        <div class="text-gray-500 text-sm mt-1">chineseteacherelena@outlook.com</div>
      </div>
      <!-- 联系人 -->
      <div class="bg-white border rounded shadow-sm flex flex-col items-center py-8">
        <div class="bg-[#009FE8] rounded-full w-16 h-16 flex items-center justify-center mb-3">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4"/>
            <path d="M2 20c0-4 8-6 10-6s10 2 10 6" />
          </svg>
        </div>
        <div class="font-semibold text-lg">Contacts</div>
        <div class="text-gray-500 text-sm mt-1">Elena Lin</div>
      </div>
    </div>

    <!-- 联系表单和介绍 -->
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-start justify-between gap-8 px-4 mb-12">
      <!-- 左侧大标题 -->
      <div class="flex-1">
        <div class="text-3xl font-bold mb-2">Get in touch now!<br>Let's explore how I can<br>help you reach your goals.</div>
      </div>
      <!-- 右侧表单 -->
      <div class="flex-1">
        <form class="space-y-3">
          <input type="text" placeholder="Name" class="w-full border border-gray-300 rounded px-2 py-2 focus:outline-none focus:border-[#009FE8]" />
          <input type="email" placeholder="Email" class="w-full border border-gray-300 rounded px-2 py-2 focus:outline-none focus:border-[#009FE8]" />
          <textarea placeholder="Message" class="w-full border border-gray-300 rounded px-2 py-2 focus:outline-none focus:border-[#009FE8]" rows="4"></textarea>
          <button type="submit" class="w-full bg-white border border-[#009FE8] text-[#009FE8] px-4 py-2 rounded hover:bg-[#009FE8] hover:text-white transition">Submit Now</button>
        </form>
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