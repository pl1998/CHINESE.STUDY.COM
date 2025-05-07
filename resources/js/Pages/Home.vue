<template>
  <div class="min-h-screen bg-white">
    <!-- 顶部导航 -->
    <header class="w-full border-b border-gray-200">
      <div class="max-w-7xl mx-auto flex items-center justify-between py-2 px-4">
        <div class="flex items-center space-x-2">
          <img src="/images/logo/logo.png" alt="logo" class="h-10 w-10" />
        </div>
        <nav class="flex-1 flex items-center justify-center space-x-6">
          <Link href="/" class="text-[#009FE8] font-semibold">Home</Link>
          <Link href="/lessons" class="text-gray-700 hover:text-[#009FE8]">1V1 LESSON</Link>
          <Link href="/recorded" class="text-gray-700 hover:text-[#009FE8]">Recorded Lesson</Link>
          <Link href="/practice" class="text-gray-700 hover:text-[#009FE8]">Daily Pratice</Link>
          <Link href="/about" class="text-gray-700 hover:text-[#009FE8]">About Me</Link>
          <Link href="/contact" class="text-gray-700 hover:text-[#009FE8]">Contact</Link>
        </nav>
        <div class="flex flex-col items-end">
          <div class="flex items-center space-x-2">
            <svg class="w-5 h-5 text-[#009FE8]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M21 10.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4.5l-7-3.5-7 3.5" />
            </svg>
            <span class="text-xs font-semibold">email</span>
          </div>
          <span class="text-xs font-semibold text-gray-800">chineseteacherelena@outlook.com</span>
        </div>
      </div>
    </header>

    <!-- Hero 区域 -->
    <section class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between py-10 px-4">
      <div class="flex-1">
        <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-2">
          Learn to be<br />
          conversational<br />
          <span class="text-[#009FE8]">in <span class="text-[#F9B233]">6 months</span> or less!</span>
        </h1>
        <p class="text-gray-700 mb-4">With the internet's <b>BEST</b> Chinese lessons!</p>
        <Link href="/lessons" class="inline-block bg-[#009FE8] hover:bg-[#007bb5] text-white font-semibold rounded px-6 py-2 transition">
          Check detail
        </Link>
      </div>
      <div class="flex-1 flex justify-center mt-8 md:mt-0">
        <!-- 视频占位 -->
        <div class="w-[400px] h-[225px] bg-gray-200 rounded-lg flex items-center justify-center relative shadow">
          <video
            ref="homeVideo"
            src="/video/logo.mp4"
            webkit-playsinline="true"
            class="w-full h-full object-cover"
            :controls="isPlaying"
            @click="playVideo"
            poster="/images/video_poster.png"
          ></video>
          <!-- 播放按钮，播放后隐藏 -->
          <svg
            v-if="!isPlaying"
            @click="playVideo"
            class="absolute w-16 h-16 text-white opacity-80 cursor-pointer z-10"
            style="left:50%;top:50%;transform:translate(-50%,-50%)"
            fill="currentColor"
            viewBox="0 0 24 24"
          >
            <circle cx="12" cy="12" r="12" fill="#000" fill-opacity="0.3"/>
            <polygon points="10,8 16,12 10,16" fill="#fff"/>
          </svg>
        </div>
      </div>
    </section>

    <!-- 统计数据 -->
    <section class="bg-[#F7F9FA] py-8">
      <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div>
          <div class="text-3xl font-bold text-[#009FE8]">500+</div>
          <div class="text-gray-700 text-sm mt-1">lesson videos</div>
        </div>
        <div>
          <div class="text-3xl font-bold text-[#009FE8]">2,000+</div>
          <div class="text-gray-700 text-sm mt-1">student</div>
        </div>
        <div>
          <div class="text-3xl font-bold text-[#009FE8]">10k+</div>
          <div class="text-gray-700 text-sm mt-1">lessos booked</div>
        </div>
        <div>
          <div class="text-3xl font-bold text-[#009FE8]">10M+</div>
          <div class="text-gray-700 text-sm mt-1">follower</div>
        </div>
      </div>
    </section>

    <!-- 图片区域 -->
    <section class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 py-8 px-4">
      <div class="flex-1 flex justify-center">
        <div class="relative w-[420px] h-[300px] bg-gray-300 rounded-lg flex items-center justify-center group overflow-hidden">
          <span class="text-gray-400">
            <img src="/images/home_left.jpg" alt="home1" class="w-full h-full object-cover" />
          </span>
          <!-- 悬浮文字层 -->
          <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <span class="text-white text-lg font-semibold text-center px-4">One-on-one online courses, personalized customization, flexible arrangement</span>
          </div>
        </div>
      </div>
      <div class="flex-1 flex justify-center">
        <div class="relative w-[420px] h-[300px] bg-gray-300 rounded-lg flex items-center justify-center group overflow-hidden">
          <span class="text-gray-400">
            <img src="/images/home_right.png" alt="home2" class="w-full h-full object-cover" />
          </span>
          <!-- 悬浮文字层 -->
          <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <span class="text-white text-lg font-semibold text-center px-4">Immersive Chinese experience helps you speak with confidence</span>
          </div>
        </div>
      </div>
    </section>

    <!-- 标题与介绍 -->
    <section class="max-w-3xl mx-auto text-center py-6 px-4">
      <h2 class="text-2xl md:text-3xl font-bold mb-2">Master Mandarin with <span class="text-[#009FE8]">Confidence</span></h2>
      <p class="text-gray-700">
        My courses are designed to meet you where you are and take you where you want to go. From everyday communication to specialized topics like travel, business, or exam preparation, each lesson is tailored to your learning style. With clear goals, engaging methods, and personalized support, I'll help you unlock the full potential of your Chinese language journey.
      </p>
    </section>

    <!-- How it works -->
    <section class="max-w-5xl mx-auto py-8 px-4">
      <h3 class="text-2xl font-bold text-center mb-6">
        How <span class="text-[#F9B233]">it works</span>
      </h3>
      <div class="grid md:grid-cols-3 gap-8 text-gray-700 text-sm">
        <div>
          <span class="font-bold text-[#009FE8]">1.</span> Select the course you want to take, if you choose the recorded courses, we will automatically send the video file to your email after payment.
        </div>
        <div>
          <span class="font-bold text-[#009FE8]">2.</span> If you want to take online 1v1 courses, select the type of courses you want to take, and select the number of courses/frequency of classes, choose the time that suits you and pay.
        </div>
        <div>
          <span class="font-bold text-[#009FE8]">3.</span> After payment, your email address will receive a zoom meeting link. Meanwhile, if you are booking my course for the first time, you can leave me a message and tell me about yourself, such as where are you from, whether you have studied Chinese before, and what learning goals you want to achieve. With this information, I can better prepare for our first class!
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section class="max-w-5xl mx-auto py-8 px-4">
      <h3 class="text-2xl font-bold text-center mb-6">
        Frequently Asked <span class="text-[#F9B233]">Questions</span>
      </h3>
      <div class="space-y-4">
        <div class="bg-[#F7FCFE] border-l-4 border-[#009FE8] rounded p-4">
          <div class="font-bold text-[#009FE8] mb-1">How fast will I learn basic Chinese using Yoyo Chinese?</div>
          <div class="text-gray-700 text-sm">
            Fast! In less than 30 days you'll be able to correctly pronounce every possible sound in Chinese (pinyin and tones) and even know how to introduce yourself, count to ten, greet and bid farewell, and many other basic skills! In less than 6 months you'll be proficient in basic conversational Chinese. Hard to believe? Check out the "What our students have to say" section to hear from other Chinese language learners just like you!
          </div>
        </div>
        <div class="bg-[#FFF8ED] border-l-4 border-[#F9B233] rounded p-4">
          <div class="font-bold text-[#F9B233] mb-1">Does Yoyo Chinese actually work?</div>
          <div class="text-gray-700 text-sm">
            Yes! And you can read all about the details of why and how here on Yoyo Chinese, but don't just take it from us - check out the "What our students have to say" section and hear it directly from them about how Yoyo Chinese is "the best Chinese language learning program out there", "better than the competition", "highly effective", "super fun to use", "perfect for beginners", and "worth every penny."
          </div>
        </div>
        <div class="bg-[#F7FCFE] border-l-4 border-[#009FE8] rounded p-4">
          <div class="font-bold text-[#009FE8] mb-1">What makes Yoyo Chinese so much better than the competition?</div>
          <div class="text-gray-700 text-sm">
            Most Chinese learning apps are a business first and a learning program second - but NOT Yoyo Chinese. We don't use AI and other shortcuts aimed at cutting costs. Instead, our team consists of real live Chinese language experts - both foreign and native - who are truly dedicated to creating the world's best online Chinese learning program. We don't just simply use technology, WE TEACH.
          </div>
        </div>
        <div class="bg-[#FFF8ED] border-l-4 border-[#F9B233] rounded p-4">
          <div class="font-bold text-[#F9B233] mb-1">Does Yoyo Chinese teach simplified or traditional characters?</div>
          <div class="text-gray-700 text-sm">
            While our Chinese Character Courses use simplified Chinese characters in the video lessons, Yoyo Chinese is fully optimized for learning with traditional characters. With just the flip of a switch your flashcards, quiz questions (minus the images), and other features will be in traditional. And guess what? 70% of the 600 characters in our Chinese Character Course are no different in traditional than in simplified!
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="bg-[#F7F9FA] py-10">
      <div class="max-w-3xl mx-auto text-center">
        <h3 class="text-2xl font-bold mb-4">Join us and have fun learning Chinese!</h3>
        <Link href="/register" class="inline-block bg-[#009FE8] hover:bg-[#007bb5] text-white font-semibold rounded px-8 py-2 transition">
          Get started
        </Link>
      </div>
    </section>

    <!-- 页脚 -->
    <footer class="bg-white border-t border-gray-200 py-8">
      <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 px-4 text-sm">
        <div>
          <img src="/images/logo/logo.png" alt="logo" class="h-10 mb-2" />
          <div class="text-gray-500">Copyright © 2025. All rights reserved.<br />ELENA MANDARIN</div>
          <div class="flex space-x-4 mt-2">
            <a href="#" class="text-gray-400 hover:text-[#009FE8] transition-colors">
              <i class="fab fa-instagram text-xl"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-[#009FE8] transition-colors">
              <i class="fab fa-facebook text-xl"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-[#009FE8] transition-colors">
              <i class="fab fa-youtube text-xl"></i>
            </a>
          </div>
        </div>
        <div>
          <div class="font-bold mb-2">Site Navigation</div>
          <ul class="space-y-1">
            <li><Link href="/">Home</Link></li>
            <li><Link href="/lessons">1V1 LESSON</Link></li>
            <li><Link href="/recorded">Recorded Lesson</Link></li>
            <li><Link href="/practice">Daily Pratice</Link></li>
            <li><Link href="/about">About Me</Link></li>
            <li><Link href="/contact">Contact</Link></li>
          </ul>
        </div>
        <div>
          <div class="font-bold mb-2">1V1 LESSON</div>
          <ul class="space-y-1">
            <li>hsk-1-6</li>
            <li>survival chinese</li>
            <li>conversational chinese</li>
            <li>Fun Chinese Debate Topics</li>
          </ul>
        </div>
        <div>
          <div class="font-bold mb-2">Newsletter</div>
          <div class="text-gray-500 mb-2">We love sharing tips, resources and stories to help Chinese language learners just like you. Subscribe and learn with us!</div>
          <form class="flex space-x-2">
            <input type="email" placeholder="Submit Now" class="flex-1 border border-gray-300 rounded px-2 py-1 focus:outline-none focus:border-[#009FE8]" />
            <button type="submit" class="bg-[#009FE8] text-white px-4 py-1 rounded hover:bg-[#007bb5]">Submit</button>
          </form>
        </div>
      </div>
      <div class="text-center text-gray-400 text-xs mt-6">Copyright @ 2025 . All rights reserved. ELENA MANDARIN</div>
    </footer>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const isPlaying = ref(false);
const homeVideo = ref(null);

function playVideo() {
  if (homeVideo.value) {
    homeVideo.value.play();
    isPlaying.value = true;
  }
}
</script>
