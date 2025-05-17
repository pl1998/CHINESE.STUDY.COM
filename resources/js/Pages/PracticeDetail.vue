<template>
    <Layout :config="config">
<div class="pt-[112px]">
    <!-- 顶部黑色全宽区域 -->
    <div class="w-full bg-black flex flex-col items-center justify-center py-12 px-0 relative" style="min-height:320px;">
      <div class="w-full max-w-5xl flex flex-col md:flex-row items-start md:items-center justify-between px-0 md:px-8">
        <!-- 左侧主内容 -->
        <div class="flex-1 min-w-0 md:pl-8">
          <div class="flex items-center gap-2 mb-2 text-sm">
            <span class="text-white/80 flex items-center"><FontAwesomeIcon :icon="['fas', 'bookmark']" class="mr-1"/>Beginner</span>
            <span class="text-white/80">Fun, {{practice.level_label.toUpperCase()}}</span>
          </div>
          <h1 class="text-white text-4xl md:text-5xl font-bold mb-2 mt-2" style="letter-spacing:0.5px;">{{practice.name}}</h1>
          <h2 class="text-blue-400 text-2xl md:text-3xl font-bold mb-4">{{practice.zh_name}}</h2>
          <div class="flex gap-2 mb-0">
            <!-- <button class="bg-black border border-white/30 text-white text-xs px-4 py-1 rounded hover:bg-white hover:text-black transition">Simplified</button>
            <button class="bg-black border border-white/30 text-white text-xs px-4 py-1 rounded hover:bg-white hover:text-black transition">Pinyin On</button>
            <button class="bg-black border border-white/30 text-white text-xs px-4 py-1 rounded hover:bg-white hover:text-black transition">Space Off</button> -->
          </div>
        </div>
        <!-- 右侧图片区域 -->
        <div class="w-full md:w-[340px] flex-shrink-0 mt-8 md:mt-0 flex justify-center md:justify-end pr-0 md:pr-8">
          <div class="w-[320px] h-[160px] bg-gray-200 rounded border-2 border-white/30 flex items-center justify-center overflow-hidden">
            <!-- 图片占位 -->
            <span class="text-gray-400"><img :src="practice.cover" alt="practice image"></span>
          </div>
        </div>
      </div>
    </div>
    <!-- 课文内容区域，距离顶部黑色区域仅80px -->
    <div class="bg-white min-h-screen py-8 px-4 max-w-3xl mx-auto" style="margin-top:-50px; position:relative; z-index:2; box-shadow:0 8px 24px 0 rgba(0,0,0,0.04);">
      <!-- 顶部区域优化 -->
      <!-- 课文内容 -->
      <div class="bg-50 p-4 rounded mb-6">
        <div v-html="practice.content"></div>
      </div>
      <!-- 音乐播放按钮 -->
      <div class="flex items-center gap-3 mb-6">
        <button @click="toggleAudio" class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white text-2xl focus:outline-none">
          <FontAwesomeIcon :icon="['fas', isPlaying ? 'pause' : 'volume-up']" />
        </button>
        <span class="text-lg font-semibold">{{practice.name}}</span>
        <audio ref="audioRef" :src="practice.audio" @timeupdate="onTimeUpdate" @loadedmetadata="onLoadedMetadata" @progress="onProgress" />
      </div>
      <div class="w-full h-2 bg-gray-300 rounded mb-1 relative cursor-pointer select-none"
           @mousedown="onDragStart"
           @touchstart="onDragStart"
           @click="seekAudio($event)">
        <!-- 缓冲进度条 -->
        <div class="absolute top-0 left-0 h-2 bg-blue-200 rounded" :style="{ width: bufferPercent + '%' }"></div>
        <!-- 播放进度条 -->
        <div class="h-2 bg-green-400 rounded" :style="{ width: progressPercent + '%' }"></div>
        <!-- 拖拽圆点 -->
        <div class="absolute top-0 left-0 h-2" :style="{ left: progressPercent + '%', transform: 'translateX(-50%)' }">
          <div class="w-3 h-3 bg-green-500 rounded-full border-2 border-white shadow cursor-pointer" v-if="audioDuration > 0"></div>
        </div>
      </div>
      <div class="flex justify-between text-xs text-gray-500 mb-6" v-if="audioDuration > 0">
        <span>{{ formatTime(audioCurrent) }}</span>
        <span>-{{ formatTime(audioDuration - audioCurrent) }}</span>
      </div>
      <!-- 会员提示 -->
      <div class="bg-blue-50 border border-blue-200 rounded p-6 flex flex-col items-center mb-8">
        <div class="text-4xl text-blue-400 mb-2">
          <svg t="1747460232124" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="10727" width="128" height="128"><path d="M38.04 518.35a475.12 487.33 0 1 0 950.24 0 475.12 487.33 0 1 0-950.24 0Z" fill="#07AA74" p-id="10728"></path><path d="M513.16 18.75C258.74 18.75 52.5 224.99 52.5 479.41s206.25 460.66 460.66 460.66 460.66-206.25 460.66-460.66S767.58 18.75 513.16 18.75z m0 769.72c-170.69 0-309.06-138.37-309.06-309.06s138.37-309.06 309.06-309.06 309.06 138.37 309.06 309.06-138.37 309.06-309.06 309.06z" fill="#56D8B0" p-id="10729"></path><path d="M613.02 448.9c-1.48-0.15-2.97-0.22-4.48-0.22H459.7v-55.3c0-29.47 23.98-53.46 53.46-53.46s53.46 23.99 53.46 53.46v0.18c0 12.76 10.31 23.13 23.07 23.2 12.86 0.07 23.33-10.34 23.33-23.2v0.92c0-54.22-42.79-99.39-96.99-100.92-56.37-1.59-102.73 43.81-102.73 99.82v55.52c-23.44 2.26-41.92 22.17-41.92 46.18V618.9c0 25.52 20.88 46.4 46.4 46.4h190.75c25.52 0 46.4-20.88 46.4-46.4V495.08c0.01-24.01-18.47-43.91-41.91-46.18z m-84.49 125.17v23.8c0 8.49-6.88 15.37-15.37 15.37-8.49 0-15.37-6.88-15.37-15.37v-23.8c-13.46-5.91-22.85-19.36-22.85-35 0-21.11 17.11-38.22 38.22-38.22s38.23 17.11 38.23 38.22c0 15.63-9.4 29.08-22.86 35z" fill="#FFFFFF" p-id="10730"></path></svg>
        </div>
        <div class="text-center text-blue-900 font-semibold mb-2">
          Logged-in premium members can access Exercises, Notes, Translation and Download Center
        </div>
        <a href="#" class="text-pink-600 font-bold" @click.prevent="showPackageModal = true">Learn more &gt;&gt;</a>
        <!-- <div class="text-xs mt-2 text-gray-500">Already a subscriber? <a href="#" class="underline">Sign in.</a></div> -->
      </div>
      <!-- 套餐弹窗 -->
      <div v-if="showPackageModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-xs relative">
          <button class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl" @click="showPackageModal = false">&times;</button>
          <!-- 套餐卡片 -->
          <div class="rounded-2xl bg-white p-6 flex flex-col items-center shadow mb-6">
            <div class="absolute right-0 top-0">
              <span class="bg-blue-600 text-white text-xs font-bold px-4 py-1 rounded-bl-lg rounded-tr-lg rotate-45 block" style="position:absolute;right:-40px;top:18px;width:120px;text-align:center;transform:rotate(45deg);">POPULAR</span>
            </div>
            <div class="text-purple-700 font-bold text-2xl mb-1 mt-2">LIFETIME</div>
            <div class="text-gray-500 mb-2">access forever!</div>
            <div class="flex items-center gap-2 mb-2">
              <span class="text-gray-400 line-through text-lg">${{practice.origin_price}}</span>
              <span class="text-orange-400 text-3xl font-bold">${{practice.price}}</span>
            </div>
            <button class="border border-orange-400 text-orange-400 rounded px-8 py-2 font-bold mt-2 mb-2 hover:bg-orange-50">SELECT</button>
            <div class="text-xs text-gray-400">one-time payment</div>
          </div>
          <!-- 备注描述 -->
          <div class="text-xs text-13 text-gray-600 mb-4 text-center">
            To subscribe to this course, please leave your email address and phone number. After successful payment, all the course content will be sent to your email. Please check your email in time!
          </div>
          <!-- 表单 -->
          <form class="space-y-3" @submit.prevent="submitPackageForm">
            <div>
              <input v-model="packageForm.name" type="text" class="w-full border rounded p-2" placeholder="Name" />
              <div v-if="packageErrors.name" class="text-red-600 text-xs mt-1">{{ packageErrors.name }}</div>
            </div>
            <div>
              <input v-model="packageForm.email" type="email" class="w-full border rounded p-2" placeholder="Email" />
              <div v-if="packageErrors.email" class="text-red-600 text-xs mt-1">{{ packageErrors.email }}</div>
            </div>
            <div>
              <input v-model="packageForm.phone" type="text" class="w-full border rounded p-2" placeholder="Phone" />
              <div v-if="packageErrors.phone" class="text-red-600 text-xs mt-1">{{ packageErrors.phone }}</div>
            </div>
            <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 rounded mt-2 flex items-center justify-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M22.5 6.5a2.5 2.5 0 0 0-2.5-2.5h-16A2.5 2.5 0 0 0 1.5 6.5v11A2.5 2.5 0 0 0 4 20h16a2.5 2.5 0 0 0 2.5-2.5v-11ZM4 5h16a1.5 1.5 0 0 1 1.5 1.5V8H2.5V6.5A1.5 1.5 0 0 1 4 5Zm16 14H4A1.5 1.5 0 0 1 2.5 17.5V9H21.5v8.5A1.5 1.5 0 0 1 20 19Z"/><path d="M7.5 15.5a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 1 0v2a.5.5 0 0 1-.5.5Zm3.5 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 1 0v2a.5.5 0 0 1-.5.5Zm3.5 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 1 0v2a.5.5 0 0 1-.5.5Z"/></svg>
              PayPal
            </button>
            <!-- 表单下方新增关闭按钮 -->
            <button type="button"
                    class="w-full mt-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 rounded"
                    @click="showPackageModal = false">
              Close
            </button>
          </form>
        </div>
      </div>
      <!-- 评论区 --> 
      <div class="mb-6">
        <div class="flex gap-2 mb-2">
          <a class="text-purple-400 hover:text-[#009FE8] transition-colors" :href="config.instagram_url" target="_blank"><FontAwesomeIcon :icon="['fab', 'instagram']" /></a>
          <a class="text-black-400 hover:text-[#009FE8] transition-colors" :href="config.tiktok_url" target="_blank"><FontAwesomeIcon :icon="['fab', 'tiktok']" /></a>
          <a class="text-red-400 hover:text-[#009FE8] transition-colors" :href="config.youtube_url" target="_blank"><FontAwesomeIcon :icon="['fab', 'youtube']" /></a>
        </div>
        <h3 class="text-lg font-bold mb-4 mt-4">{{practice.topics.length}} Comments</h3>
        <div class="mb-4 border-b pb-2" v-for="topic in practice.topics" :key="topic.id">
          <div class="font-semibold text-pink-700">{{topic.name}}</div>
          <div class="text-xs text-gray-400">{{topic.created_at}}</div>
          <div class="text-gray-700">{{topic.content}}</div>
        </div>
      </div>
      <!-- 留言表单 -->
      <div class="mb-8">
        <h3 class="text-lg font-bold mb-2">Leave a Reply</h3>
        <form class="space-y-4" @submit.prevent="submitComment">
          <div>
            <textarea v-model="form.content" class="w-full border rounded p-2" rows="4" placeholder="Comment *"></textarea>
            <div v-if="errors.content" class="text-red-600 text-xs mt-1">{{ errors.content }}</div>
          </div>
          <div>
            <input v-model="form.name" class="w-full border rounded p-2" type="text" placeholder="Name" />
            <div v-if="errors.name" class="text-red-600 text-xs mt-1">{{ errors.name }}</div>
          </div>
          <div>
            <input v-model="form.email" class="w-full border rounded p-2" type="email" placeholder="Email" />
            <div v-if="errors.email" class="text-red-600 text-xs mt-1">{{ errors.email }}</div>
          </div>
          <div>
            <input v-model="form.website" class="w-full border rounded p-2" type="text" placeholder="Website" />
            <div v-if="errors.website" class="text-red-600 text-xs mt-1">{{ errors.website }}</div>
          </div>
          <div class="flex items-center">
            <input type="checkbox" id="isShow" v-model="form.is_show" true-value="1" false-value="0" class="mr-2" />
            <label for="isShow" class="text-sm">Save my name, email, and website in this browser for the next time I comment.</label>
          </div>
          <button type="submit" class="bg-pink-700 text-white px-4 py-2 rounded">Post Comment</button>
        </form>
      </div>
    </div>

</div>
    </Layout>
  </template>
  
  <script setup>
import { ref, reactive, onMounted, onBeforeUnmount } from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faVolumeUp, faPause } from '@fortawesome/free-solid-svg-icons'
import { faFacebookF, faTwitter, faWhatsapp, faInstagram, faTiktok, faYoutube } from '@fortawesome/free-brands-svg-icons'
library.add(faVolumeUp, faPause, faFacebookF, faTwitter, faWhatsapp, faInstagram, faTiktok, faYoutube)
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
  import Layout from '@/Layouts/App.vue'
import { usePage, router } from '@inertiajs/vue3'
import Swal from 'sweetalert2'
const isPlaying = ref(false)
const audioRef = ref(null)
const { practice } = usePage().props
import axios from 'axios'
const form = reactive({
  name: '',
  email: '',
  content: '',
  website: '',
  is_show: true
})
const errors = reactive({
  name: '',
  email: '',
  content: '',
  website: ''
})

function validateEmail(email) {
  // 简单邮箱正则
  return /^\S+@\S+\.\S+$/.test(email)
}

function submitComment() {
  // 清空错误
  errors.name = ''
  errors.email = ''
  errors.content = ''
  errors.website = ''

  let valid = true
  if (!form.name) {
    errors.name = 'Name is required.'
    valid = false
  } else if (form.name.length > 40) {
    errors.name = 'Name must be at most 40 characters.'
    valid = false
  }
  if (!form.email) {
    errors.email = 'Email is required.'
    valid = false
  } else if (!validateEmail(form.email)) {
    errors.email = 'Email is invalid.'
    valid = false
  }
  if (!form.content) {
    errors.content = 'Comment is required.'
    valid = false
  } else if (form.content.length > 2000) {
    errors.content = 'Comment must be at most 2000 characters.'
    valid = false
  }
  if (form.website && form.website.length > 255) {
    errors.website = 'Website must be at most 255 characters.'
    valid = false
  }
  if (!valid) return

  axios.post('/api/course_practice_topic',{
    name: form.name,
    email: form.email,
    content: form.content,
    website: form.website,
    practice_id: practice.id,
    is_show: form.is_show
  }).then((response) => {
    if (response.data.status == 200) {
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Your comment has been submitted!'
      })
      form.name = ''
      form.email = ''
      form.content = ''
      form.website = ''
      form.is_show = true
    }
  }).catch((error) => {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: error.response.data.message
    })
  })  
}
  defineProps({
    config: {
      type: Object,
      required: true
    }
  })
function toggleAudio() {
  if (!audioRef.value) return
  if (isPlaying.value) {
    audioRef.value.pause()
    isPlaying.value = false
  } else {
    audioRef.value.play()
    isPlaying.value = true
  }
}

const audioDuration = ref(0)
const audioCurrent = ref(0)
const progressPercent = ref(0)
const bufferPercent = ref(0)
const isDragging = ref(false)

function onTimeUpdate(event) {
  if (!isDragging.value) {
    const currentTime = event.target.currentTime
    audioCurrent.value = currentTime
    audioDuration.value = event.target.duration
    progressPercent.value = (currentTime / audioDuration.value) * 100
  }
}

function onLoadedMetadata(event) {
  audioDuration.value = event.target.duration
}

function onProgress(event) {
  const audio = event.target
  if (audio.buffered.length > 0) {
    const bufferedEnd = audio.buffered.end(audio.buffered.length - 1)
    bufferPercent.value = (bufferedEnd / audio.duration) * 100
  }
}

function seekAudio(event) {
  if (!audioRef.value || !audioDuration.value) return
  const rect = event.target.getBoundingClientRect()
  const clientX = event.type.startsWith('touch') ? event.touches[0].clientX : event.clientX
  const clickX = clientX - rect.left
  const clickPercent = (clickX / rect.width) * 100
  const seekTime = (clickPercent / 100) * audioDuration.value
  audioRef.value.currentTime = seekTime
}

function onDragStart(event) {
  if (!audioRef.value || !audioDuration.value) return
  isDragging.value = true
  document.addEventListener('mousemove', onDragMove)
  document.addEventListener('mouseup', onDragEnd)
  document.addEventListener('touchmove', onDragMove)
  document.addEventListener('touchend', onDragEnd)
  onDragMove(event)
}

function onDragMove(event) {
  if (!isDragging.value || !audioRef.value || !audioDuration.value) return
  const bar = event.target.closest('.w-full')
  if (!bar) return
  const rect = bar.getBoundingClientRect()
  const clientX = event.type.startsWith('touch') ? (event.touches[0]?.clientX ?? 0) : event.clientX
  let dragX = clientX - rect.left
  dragX = Math.max(0, Math.min(dragX, rect.width))
  const percent = (dragX / rect.width) * 100
  progressPercent.value = percent
  audioCurrent.value = (percent / 100) * audioDuration.value
}

function onDragEnd(event) {
  if (!isDragging.value || !audioRef.value || !audioDuration.value) return
  isDragging.value = false
  const bar = document.querySelector('.w-full.h-2')
  if (!bar) return
  const rect = bar.getBoundingClientRect()
  const clientX = event.type.startsWith('touch') ? (event.changedTouches[0]?.clientX ?? 0) : event.clientX
  let dragX = clientX - rect.left
  dragX = Math.max(0, Math.min(dragX, rect.width))
  const percent = (dragX / rect.width) * 100
  const seekTime = (percent / 100) * audioDuration.value
  audioRef.value.currentTime = seekTime
  document.removeEventListener('mousemove', onDragMove)
  document.removeEventListener('mouseup', onDragEnd)
  document.removeEventListener('touchmove', onDragMove)
  document.removeEventListener('touchend', onDragEnd)
}

function formatTime(time) {
  if (!time && time !== 0) return '00:00'
  const min = Math.floor(time / 60)
  const sec = Math.floor(time % 60)
  return `${min.toString().padStart(2, '0')}:${sec.toString().padStart(2, '0')}`
}

onBeforeUnmount(() => {
  document.removeEventListener('mousemove', onDragMove)
  document.removeEventListener('mouseup', onDragEnd)
  document.removeEventListener('touchmove', onDragMove)
  document.removeEventListener('touchend', onDragEnd)
})

const showPackageModal = ref(false)
const packageForm = reactive({
  name: '',
  email: '',
  phone: ''
})
const packageErrors = reactive({
  name: '',
  email: '',
  phone: ''
})
function validatePackageEmail(email) {
  return /^\S+@\S+\.\S+$/.test(email)
}
async function submitPackageForm() {
  packageErrors.name = ''
  packageErrors.email = ''
  packageErrors.phone = ''
  let valid = true
  if (!packageForm.name) {
    packageErrors.name = 'Name is required.'
    valid = false
  } else if (packageForm.name.length > 20) {
    packageErrors.name = 'Name must be at most 20 characters.'
    valid = false
  }
  if (!packageForm.email) {
    packageErrors.email = 'Email is required.'
    valid = false
  } else if (!validatePackageEmail(packageForm.email)) {
    packageErrors.email = 'Email is invalid.'
    valid = false
  }
  if (!packageForm.phone) {
    packageErrors.phone = 'Phone is required.'
    valid = false
  }
  if (!valid) return

  // 发起支付请求
  try {
    const res = await axios.post('/api/practice/paypal', {
      name: packageForm.name,
      email: packageForm.email,
      phone: packageForm.phone,
      price: practice.price,
      practice_id: practice.id
    });
    if (res.data && res.data.paypal_url) {
      window.location.href = res.data.paypal_url; // 跳转到PayPal支付
    } else {
      Swal.fire({ icon: 'error', title: 'Payment failed', text: 'Failed to obtain the payment link' })
    }
  } catch (e) {
    Swal.fire({ icon: 'error', title: 'Payment failed', text: 'Failed to obtain the payment link' })
  }
}
  </script>

<style scoped>
/* 可根据需要自定义样式 */
</style>