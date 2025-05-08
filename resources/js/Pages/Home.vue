<template>
  <div class="min-h-screen bg-white mt-40">

      <!-- 导航栏 -->
      <Navbar />

    <!-- Hero 区域 -->
    <section class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between py-10 px-4">
      <div class="flex-1">
        <h1 class="text-3xl text-[50px] font-bold leading-tight mb-2">
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
        <div class="w-[680px] h-[390px] bg-gray-200 rounded-lg flex items-center justify-center relative shadow">
          <video
            ref="homeVideo"
            src="/video/logo.mp4"
            webkit-playsinline="true"
            playsinline
            class="w-full h-full object-cover rounded-lg"
            :controls="isPlaying"
            @click="playVideo"
            poster="/images/video_poster.png"
            preload="auto"
          ></video>
          <!-- 播放按钮，播放后隐藏 -->
          <svg
            v-if="!isPlaying"
            @click="playVideo"
            class="absolute w-16 h-16 text-white opacity-80 cursor-pointer z-10 hover:opacity-100 transition-opacity"
            style="left:50%;top:50%;transform:translate(-50%,-50%)"
            fill="currentColor"
            viewBox="0 0 24 24"
          >
            <circle cx="12" cy="12" r="12" fill="#000" fill-opacity="0.3"/>
            <polygon points="10,8 16,12 10,16" fill="#fff"/>
          </svg>
          <!-- 音量控制按钮 -->
          <div v-if="isPlaying" class="absolute bottom-4 right-4 z-10 flex items-center space-x-2">
            <button @click="toggleMute" class="text-white hover:text-gray-200 transition-colors">
              <svg v-if="!isMuted" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
              </svg>
              <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- 统计数据 -->
    <section class="bg-[#F7F9FA] py-8">
      <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div>
          <div class="text-[50px] font-bold text-[#009FE8]">500+</div>
          <div class="text-gray-700 text-sm mt-1">lesson videos</div>
        </div>
        <div>
          <div class="text-[50px] font-bold text-[#009FE8]">2,000+</div>
          <div class="text-gray-700 text-sm mt-1">student</div>
        </div>
        <div>
          <div class="text-[50px] font-bold text-[#009FE8]">10k+</div>
          <div class="text-gray-700 text-sm mt-1">lessos booked</div>
        </div>
        <div>
          <div class="text-[50px] font-bold text-[#009FE8]">10M+</div>
          <div class="text-gray-700 text-sm mt-1">follower</div>
        </div>
      </div>
    </section>

    <!-- 图片区域 -->
    <section class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 py-8 px-4">
      <div class="flex-1 flex justify-center">
        <div class="relative w-[680px] h-[380px] rounded-lg flex items-center justify-center group overflow-hidden">
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
        <div class="relative w-[680px] h-[380px] rounded-lg flex items-center justify-center group overflow-hidden">
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
      <h2 ref="title" class="text-[50px] font-bold mb-2 opacity-0 transform -translate-x-20 transition-all duration-1000">Master Mandarin with <span class="text-[#009FE8]">Confidence</span></h2>
      <p ref="description" class="text-[16px] text-gray-700 opacity-0 transform -translate-x-20">
        My courses are designed to meet you where you are and take you where you want to go. From everyday communication to specialized topics like travel, business, or exam preparation, each lesson is tailored to your learning style. With clear goals, engaging methods, and personalized support, I'll help you unlock the full potential of your Chinese language journey.
      </p>
    </section>

    <!-- How it works -->
    <section class="max-w-5xl mx-auto py-8 px-4">
      <h2 class="text-2xl text-[50px] font-bold text-center mb-6 transition-all duration-1000">
        How <span class="text-[#F9B233]">it works</span>
      </h2>
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
      <h2 class="text-2xl text-[50px] font-bold text-center mb-6 transition-all duration-1000">
        Frequently Asked <span class="text-[#F9B233]">Questions</span>
      </h2>
      <div class="space-y-4">
        <div class="bg-[#F7FCFE] border-l-4 border-[#009FE8] rounded p-10">
          <div class="font-bold text-[22px] text-[#009FE8] mb-1">How fast will I learn basic Chinese using Yoyo Chinese?</div>
          <div class="text-gray-700 text-[16px]">
            Fast! In less than 30 days you'll be able to correctly pronounce every possible sound in Chinese (pinyin and tones) and even know how to introduce yourself, count to ten, greet and bid farewell, and many other basic skills! In less than 6 months you'll be proficient in basic conversational Chinese. Hard to believe? Check out the "What our students have to say" section to hear from other Chinese language learners just like you!?
          </div>
        </div>
        <div class="bg-[#FFF8ED] border-l-4 border-[#F9B233] rounded p-10">
          <div class="font-bold text-[22px] text-[#F9B233] mb-1">Does Yoyo Chinese actually work?</div>
          <div class="text-gray-700 text-[16px]">
            Yes! And you can read all about the details of why and how here on Yoyo Chinese, but don't just take it from us - check out the "What our students have to say" section and hear it directly from them about how Yoyo Chinese is "the best Chinese language learning program out there", "better than the competition", "highly effective", "super fun to use", "perfect for beginners", and "worth every penny."
          </div>
        </div>
        <div class="bg-[#F7FCFE] border-l-4 border-[#009FE8] rounded p-10">
          <div class="font-bold text-[22px] text-[#009FE8] mb-1">What makes Yoyo Chinese so much better than the competition?</div>
          <div class="text-gray-700 text-[16px]">
            Most Chinese learning apps are a business first and a learning program second - but NOT Yoyo Chinese. We don't use AI and other shortcuts aimed at cutting costs. Instead, our team consists of real live Chinese language experts - both foreign and native - who are truly dedicated to creating the world's best online Chinese learning program. We don't just simply use technology, WE TEACH .
          </div>
        </div>
        <div class="bg-[#FFF8ED] border-l-4 border-[#F9B233] rounded p-10">
          <div class="font-bold text-[22px] text-[#F9B233] mb-1">Does Yoyo Chinese teach simplified or traditional characters?</div>
          <div class="text-gray-700 text-[16px] ">
            While our Chinese Character Courses use simplified Chinese characters in the video lessons, Yoyo Chinese is fully optimized for learning with traditional characters. With just the flip of a switch your flashcards, quiz questions (minus the images), and other features will be in traditional. And guess what? 70% of the 600 characters in our Chinese Character Course are no different in traditional than in simplified!
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="bg-[#F7F9FA] py-10">
      <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-[50px] font-bold mb-4 transition-all duration-1000">Join us and have fun learning Chinese!</h2>
        <Link href="/register" class="inline-block bg-[#009FE8] hover:bg-[#007bb5] text-white font-semibold rounded px-8 py-2 transition">
          Get started
        </Link>
      </div>
    </section>

    <!-- 页脚 -->
    <Footer />
  </div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue'
import Footer from '../components/Footer.vue'
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, nextTick } from 'vue';

const isPlaying = ref(true);
const isMuted = ref(false);
const homeVideo = ref(null);
const title = ref(null);
const description = ref(null);

async function playVideo() {
  if (homeVideo.value) {
    try {
      homeVideo.value.muted = false;
      await homeVideo.value.play();
      isPlaying.value = true;
    } catch (error) {
      console.log('Play failed:', error);
    }
  }
}

function toggleMute() {
  if (homeVideo.value) {
    homeVideo.value.muted = !homeVideo.value.muted;
    isMuted.value = !isMuted.value;
  }
}

function animateElement(element) {
  if (element) {
    // 使用 requestAnimationFrame 确保在下一帧执行
    requestAnimationFrame(() => {
      element.style.transform = 'translateX(0)';
      element.style.opacity = '1';
    });
  }
}

onMounted(async () => {
  await nextTick();
  // 自动播放视频
  if (homeVideo.value) {
    try {
      // 先尝试静音播放
      homeVideo.value.muted = true;
      await homeVideo.value.play();
      
      // 播放成功后，延迟一小段时间再取消静音
      setTimeout(() => {
        if (homeVideo.value) {
          homeVideo.value.muted = false;
          isMuted.value = false;
        }
      }, 100);
      
      isPlaying.value = true;
    } catch (error) {
      console.log('Auto-play failed:', error);
    }
  }

  // 创建 Intersection Observer
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // 当元素进入视口时触发动画
        if (entry.target === title.value) {
          animateElement(title.value);
        } else if (entry.target === description.value) {
          // 延迟描述文字的动画
          setTimeout(() => {
            animateElement(description.value);
          }, 300);
        }
        // 动画触发后取消观察
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.1, // 当元素10%进入视口时触发
    rootMargin: '-50px' // 提前触发动画
  });

  // 开始观察元素
  if (title.value) observer.observe(title.value);
  if (description.value) observer.observe(description.value);
});
</script>

<style>
/* 添加过渡效果 */
.transform {
  transition: transform 1s cubic-bezier(0.4, 0, 0.2, 1), 
              opacity 1s cubic-bezier(0.4, 0, 0.2, 1);
  will-change: transform, opacity;
}
</style>
