<template>
<Layout :config="config">
  <div class=" min-h-screen bg-white mt-40">
    <!-- Hero 区域 -->
    <section class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between py-10 px-4">
      <div class="flex-1">
        <h1 class="text-3xl text-[50px] font-bold leading-tight mb-2">
          Learn to be<br />
          conversational<br />
          <span class="text-[#009FE8]">in <span class="text-[#F9B233]">6 months</span> or less!</span>
        </h1>
        <p class="text-gray-700 mb-4">With the internet's <b>BEST</b> Chinese lessons!</p>
        <button class="inline-block bg-[#009FE8] hover:bg-[#007bb5] text-white font-semibold rounded px-6 py-2 transition" @click="scrollToHowItWorks">
          Check detail
        </button>
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
        <div v-for="(stat, index) in stats" :key="index" class="relative">
          <div class="stat-container relative">
            <div class="text-[50px] font-bold text-[#009FE8]">{{ stat.value }}</div>
          </div>
          <div class="text-gray-700 text-sm mt-1">{{ stat.label }}</div>
        </div>
      </div>
    </section>

    <!-- 图片区域 -->
    <section class="max-w-5xl mx-auto flex flex-col md:flex-row items-start justify-center gap-8 py-8 px-4">
      <div class="flex-1 flex flex-col items-start h-full">
        <div class="relative w-[680px] h-[380px] rounded-lg flex items-center justify-center group overflow-hidden">
          <span class="text-gray-400">
            <img src="/images/home_left.jpg" alt="home1" class="w-full h-full object-cover" />
          </span>
          <!-- 悬浮文字层 -->
          <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <span class="text-white text-lg font-semibold text-center px-4">One-on-one online courses, personalized customization, flexible arrangement</span>
          </div>
        </div>
        <!-- 新内容模块 -->
        <div class="w-full text-left mt-8 flex flex-col h-full">
          <div class="h-[560px]">
          <div class="mb-2">
            <div class="text-[1.5rem] font-extrabold text-gray-800 mb-1">1. Personalized Attention:</div>
            <div class="text-gray-500 text-base">Personalized Attention: Each lesson is tailored to your specific needs, goals, and learning pace, ensuring maximum progress.</div>
          </div>
          <div class="mb-2">
            <div class="text-[1.5rem] font-extrabold text-gray-800 mb-1">2. Interactive Learning:</div>
            <div class="text-gray-500 text-base"> Real-time feedback and conversations with a professional teacher help you improve quickly and confidently.</div>
          </div>
          <div class="mb-2">
            <div class="text-[1.5rem] font-extrabold text-gray-800 mb-1">3. Flexible Scheduling:</div>
            <div class="text-gray-500 text-base"> Choose lesson times that fit your busy lifestyle, making it easy to balance learning with other commitments.</div>
          </div>
          <div class="mb-2"> 
            <div class="text-[1.5rem] font-extrabold text-gray-800 mb-1">4. Cultural Immersion: </div>
            <div class="text-gray-500 text-base">Learn not just the language but also the cultural nuances directly from a native speaker. </div>
          </div>
          <div class="mb-2">
            <div class="text-[1.5rem] font-extrabold text-gray-800 mb-1">5. Motivation and Accountability: </div>
            <div class="text-gray-500 text-base">Regular sessions with a dedicated teacher keep you motivated and on track with your goals.  </div>
          </div>
          <div class="mb-2">
            <div class="text-[1.5rem] font-extrabold text-gray-800 mb-1">6. Ideal for： </div>
            <div class="text-gray-500 text-base">Beginners who need guidance, advanced learners aiming for fluency, or anyone seeking a structured and interactive learning experience.  </div>
          </div>
          </div>
          <div class="flex justify-center mt-auto">
            <Link  href="/lessons"  class="inline-block bg-[#00D2E0] hover:bg-[#05BFCC] text-white font-semibold rounded px-8 py-2 transition">
              Book now
            </Link>
          </div>
        </div>
      </div>
      <div class="flex-1 flex flex-col items-start h-full">
        <div class="relative w-[680px] h-[380px] rounded-lg flex items-center justify-center group overflow-hidden">
          <span class="text-gray-400">
            <img src="/images/home_right.png" alt="home2" class="w-full h-full object-cover" />
          </span>
          <!-- 悬浮文字层 -->
          <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <span class="text-white text-lg font-semibold text-center px-4">Immersive Chinese experience helps you speak with confidence</span>
          </div>
        </div>
        <!-- 新内容模块 -->
        <div class="w-full text-left mt-8 flex flex-col h-full">
          <div class="h-[560px]">
          <div class="mb-2">
            <div class="text-[1.5rem] font-extrabold text-gray-800 mb-1">1. Learn at Your Own Pace</div>
            <div class="text-gray-500 text-base">1.Study whenever and wherever you want, fitting lessons into your schedule without pressure.</div>
          </div>
          <div class="mb-2">
            <div class="text-[1.5rem] font-extrabold text-gray-800 mb-1">2. Affordable and Accessible:</div>
            <div class="text-gray-500 text-base">High-quality lessons at a lower cost, available for repeated viewing to reinforce learning.</div>
          </div>
          <div class="mb-2">
            <div class="text-[1.5rem] font-extrabold text-gray-800 mb-1">3. Flexible Content：</div>
            <div class="text-gray-500 text-base">Choose topics or skills you want to focus on, from grammar to pronunciation, at your convenience. </div>
          </div>
          <div class="mb-2">
            <div class="text-[1.5rem] font-extrabold text-gray-800 mb-1">4. No Time Constraints:</div>
            <div class="text-gray-500 text-base">Pause, rewind, or replay lessons as needed, ensuring you fully understand each concept. </div>
          </div>
          <div class="mb-2">
            <div class="text-[1.5rem] font-extrabold text-gray-800 mb-1">5. Self-directed Learning: </div>
            <div class="text-gray-500 text-base">Perfect for independent learners who prefer to take control of their own study process.  </div>
          </div>
          <div class="mb-2">
            <div class="text-[1.5rem] font-extrabold text-gray-800 mb-1">6. Ideal for: </div>
            <div class="text-gray-500 text-base">Busy professionals, self-motivated learners, or those who prefer a more flexible and budget-friendly approach to learning.   </div>
          </div>
         </div>
          <div class="flex justify-center mt-auto">
            <Link href="/recorded" class="inline-block bg-[#E47938] hover:bg-[#E46416] text-white font-semibold rounded px-8 py-2 transition">
              Book now
            </Link>
          </div>
        </div>
      </div>
    </section>

    <!-- How it works -->
    <div class="max-w-5xl mx-auto flex flex-col items-center justify-center py-16">     
      <!-- 主标题 -->
      <h2 class="text-4xl md:text-5xl font-extrabold text-[#1a2233] text-center mb-5 mt-5">
        Master Mandarin with  <span class="text-[#F9B233]">Confidence</span>
      </h2>
      <p class="text-lg text-[#2d3a4a] text-center max-w-2xl">
        My courses are designed to meet you where you are and take you where you want to go. From everyday communication to specialized topics like travel, business, or exam preparation, each lesson is tailored to your learning style. With clear goals, engaging methods, andpersonalized support, I'll help you unlock the full potential of your Chinese language journey.
      </p>
    </div>
 

    <!-- How it works -->
    <section id="how-it-works" class="max-w-5xl mx-auto py-8 px-4">
      <div class="flex flex-col items-center justify-center mb-10">
        <h2 class="text-2xl text-[50px] font-bold text-center mb-6 transition-all duration-1000">
          How <span class="text-[#F9B233]">it works</span>
        </h2>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="flex flex-col items-center">
          <div class="flex items-center mb-4">
            <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#009FE8] text-white text-3xl font-bold mr-2 shadow-lg">1</span>
            <span class="text-2xl font-bold text-[#009FE8]">Watch</span>
          </div>
          <img src="/images/home/pic_how_1@2x.webp" alt="Watch" class="rounded-xl shadow-md mb-4 w-full max-w-[340px] h-[200px] object-cover" />
          <p class="text-gray-600 text-base">Select the course you want to take, if you choose the recorded courses, we will automatically send the video file to your email after payment.</p>
        </div>
        <div class="flex flex-col items-center">
          <div class="flex items-center mb-4">
            <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#00D2E0] text-white text-3xl font-bold mr-2 shadow-lg">2</span>
            <span class="text-2xl font-bold text-[#00D2E0]">Practice</span>
          </div>
          <img src="/images/home/pic_how_2@2x.webp" alt="Practice" class="rounded-xl shadow-md mb-4 w-full max-w-[340px] h-[200px] object-cover" />
          <p class="text-gray-600 text-base">if you want to take online 1v1 courses, select the type of courses you want to take, and select the number of courses/frequency of classes, choose the time that suits you and pay.</p>
        </div>
        <div class="flex flex-col items-center">
          <div class="flex items-center mb-4">
            <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#00C2FF] text-white text-3xl font-bold mr-2 shadow-lg">3</span>
            <span class="text-2xl font-bold text-[#00C2FF]">Quiz</span>
          </div>
          <img src="/images/home/pic_how_3@2x.webp" alt="Quiz" class="rounded-xl shadow-md mb-4 w-full max-w-[340px] h-[200px] object-cover" />
          <p class="text-gray-600 text-base">After payment, your email address will receive a zoom meeting link. Meanwhile, if you are booking my course for the first time, you can leave me a message and tell me about yourself, such as where are you from, whether you have studied Chinese before, and what learning goals you want to achieve. With this information, I can better prepare for our first class!</p>
        </div>
      </div>
    </section>


    <!-- FAQ -->
    <section class="max-w-5xl mx-auto py-8 px-4">
     <div class="flex flex-col items-center justify-center mb-10">
      <h2 class="text-2xl text-[50px] font-bold text-center mb-6 transition-all duration-1000 ">
        Frequently Asked <span class="text-[#F9B233]">Questions</span>
      </h2>
     </div>
      <div class="space-y-4">
        <div v-for="(item, idx) in faqs" :key="idx">
          <div
            class="flex items-center justify-between cursor-pointer rounded-t-lg px-8 py-6 text-lg font-bold select-none"
            :class="openFaq === idx ? 'bg-[#F7FCFE] text-[#009FE8]' : 'bg-[#FFF8ED] text-[#222]'"
            @click="toggleFaq(idx)"
          >
            <span>{{ item.q }}</span>
            <svg :class="['transition-transform duration-300', openFaq === idx ? 'rotate-180' : '']" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <transition name="faq-fade">
            <div v-show="openFaq === idx" class="bg-[#F7FCFE] px-8 pb-6 text-gray-700 text-base rounded-b-lg">
              {{ item.a }}
            </div>
          </transition>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="bg-[#F7F9FA] py-10">
      <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-[50px] font-bold mb-4 transition-all duration-1000">Join us and have fun learning Chinese!</h2>
        <button class="inline-block bg-[#009FE8] hover:bg-[#007bb5] text-white font-semibold rounded px-8 py-2 transition" @click.prevent="showLessonDialog">
          Get started
        </button>
      </div>
    </section>
  </div>
</Layout>
</template>

<script setup>
import Layout from '@/Layouts/App.vue'
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, nextTick } from 'vue';
import Swal from 'sweetalert2';

defineProps({
  config: {
    type: Object,
    required: true
  }
})

const isPlaying = ref(true);
const isMuted = ref(false);
const homeVideo = ref(null);
const title = ref(null);
const description = ref(null);

const stats = ref([
  { value: '500+', label: 'Lessons videos' },
  { value: '2,000+', label: 'Students' },
  { value: '10k+', label: 'Lessons bookeds' },
  { value: '10M+', label: 'Followers' }
]);



const faqs = [
  {
    q: 'How fast will I learn basic Chinese using Yoyo Chinese?',
    a: `Fast! In less than 30 days you'll be able to correctly pronounce every possible sound in Chinese (pinyin and tones) and even know how to introduce yourself, count to ten, greet and bid farewell, and many other basic skills! In less than 6 months you'll be proficient in basic conversational Chinese. Hard to believe? Check out the "What our students have to say" section to hear from other Chinese language learners just like you!`
  },
  {
    q: 'Does Yoyo Chinese actually work?',
    a: `Yes! And you can read all about the details of why and how here on Yoyo Chinese, but don't just take it from us - check out the "What our students have to say" section and hear it directly from them about how Yoyo Chinese is "the best Chinese language learning program out there", "better than the competition", "highly effective", "super fun to use", "perfect for beginners", and "worth every penny." 🙂`
  },
  {
    q: 'What makes Yoyo Chinese so much better than the competition?',
    a: `Most Chinese learning apps are a business first and a learning program second - but NOT Yoyo Chinese. We don't use AI and other shortcuts aimed at cutting costs. Instead, our team consists of real live Chinese language experts - both foreign and native - who are truly dedicated to creating the world's best online Chinese learning program. We don't just simply use technology, WE TEACH 👩🏻‍🏫.`
  },
  {
    q: 'Does Yoyo Chinese teach simplified or traditional characters?',
    a: `While our Chinese Character Courses use simplified Chinese characters in the video lessons, Yoyo Chinese is fully optimized for learning with traditional characters. With just the flip of a switch your flashcards, quiz questions (minus the images), and other features will be in traditional. And guess what? 70% of the 600 characters in our Chinese Character Course are no different in traditional than in simplified! 😊`
  }
];

const openFaq = ref(null);
function toggleFaq(idx) {
  openFaq.value = openFaq.value === idx ? null : idx;
}


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

function createFloatingNumber(element) {
  const number = Math.floor(Math.random() * 6) + 1;
  const floatingEl = document.createElement('div');
  floatingEl.textContent = '+' + number;
  floatingEl.className = 'floating-number';
  floatingEl.style.left = Math.random() * 270 + 'px';
  floatingEl.style.bottom = '50px';
  
  element.appendChild(floatingEl);
  
  setTimeout(() => {
    floatingEl.remove();
  }, 1500);
}

function startAnimation(element) {
  createFloatingNumber(element);
  setTimeout(() => {
    startAnimation(element);
  }, Math.random() * 2000 + 1000);
}

function showLessonDialog() {
  Swal.fire({
    title: 'Choose a section',
    showCancelButton: true,
    showConfirmButton: false,
    cancelButtonText: 'Close',
    html: `
      <div style="display: flex; flex-direction: column; gap: 20px; align-items: center;">
        <button id="lv1-btn" style="width: 220px; padding: 12px 0; background: #009FE8; color: #fff; border: none; border-radius: 8px; font-size: 18px; font-weight: bold; cursor: pointer;">Lv1 Lessons</button>
        <button id="recorded-btn" style="width: 220px; padding: 12px 0; background: #F9B233; color: #fff; border: none; border-radius: 8px; font-size: 18px; font-weight: bold; cursor: pointer;">Recorded Lesson</button>
        <button id="daily-btn" style="width: 220px; padding: 12px 0; background: #00C2FF; color: #fff; border: none; border-radius: 8px; font-size: 18px; font-weight: bold; cursor: pointer;">Daily Practice</button>
      </div>
    `,
    didOpen: () => {
      document.getElementById('lv1-btn').onclick = () => {
        window.location.href = '/lessons';
      };
      document.getElementById('recorded-btn').onclick = () => {
        window.location.href = '/recorded';
      };
      document.getElementById('daily-btn').onclick = () => {
        window.location.href = '/practice';
      };
    }
  });
}

function scrollToHowItWorks() {
  const el = document.getElementById('how-it-works');
  if (el) {
    el.scrollIntoView({ behavior: 'smooth', block: 'start' });
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

  const statElements = document.querySelectorAll('.stat-container');
  statElements.forEach(element => {
    startAnimation(element);
  });
});
</script>

<style>
/* 添加过渡效果 */
.transform {
  transition: transform 1s cubic-bezier(0.4, 0, 0.2, 1),
              opacity 1s cubic-bezier(0.4, 0, 0.2, 1);
  will-change: transform, opacity;
}

@keyframes floatNumber {
  0% {
    opacity: 1;
    transform: translate(0, 0) scale(1);
  }
  100% {
    opacity: 0;
    transform: translate(30px, -30px) scale(0.5);
  }
}

.floating-number {
  position: absolute;
  color: #009FE8;
  font-size: 26px;
  animation: floatNumber 1.5s ease-out forwards;
  font-weight: bold;
}

.faq-fade-enter-active, .faq-fade-leave-active {
  transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
.faq-fade-enter-from, .faq-fade-leave-to {
  max-height: 0;
  opacity: 0;
  padding-top: 0;
  padding-bottom: 0;
}
.faq-fade-enter-to, .faq-fade-leave-from {
  max-height: 500px;
  opacity: 1;
  padding-top: 16px;
  padding-bottom: 16px;
}

.space-y-4 > * + * {
  margin-top: 10px !important;
}
</style>
