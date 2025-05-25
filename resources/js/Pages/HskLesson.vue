<template>
<Layout :config="config">
  <div class="min-h-screen bg-white">
    <!-- 导航栏 -->

    <div class="pt-[88px]">
    <!-- 课程介绍主区域 -->
    <div class="w-full bg-[#eaf2f3] py-12 mt-30">
      <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-8 px-4">
        <!-- 左侧标题和图片 -->
        <div class="flex-1 flex flex-col justify-center">
          <div class="text-[#6b7a8f] text-xs mb-2 tracking-widest"></div>
          <div class="text-[30px] md:text-[36px] leading-tight font-bold mb-6 text-[#2d3a4a]">
            {{ lesson.name }}
          </div>
          <div class="w-full h-64 bg-white flex items-center justify-center border border-gray-200 rounded mb-6">
            <img
              v-if="lesson.detail_image"
              :src="lesson.detail_image"
              :alt="lesson.name"
              class="w-auto h-full object-contain rounded-lg"
            />
          </div>
          <button
            class="bg-[#6ec1e4] text-white px-8 py-2 rounded font-semibold hover:bg-[#009FE8] transition text-lg shadow-md"
            @click="showLessonModal = true"
          >
            book now
          </button>
        </div>
        <!-- 右侧介绍 -->
        <div class="flex-1 flex flex-col justify-center">
          <!-- <div class="text-[#2d3a4a] font-semibold mb-2 text-base">{{ lesson.description }}</div> -->
          <div class="text-gray-700 text-sm leading-relaxed prose max-w-none" v-html="lesson.content"></div>
        </div>
      </div>
    </div>

    <!-- FAQ 区域 -->
    <div class="w-full bg-cover bg-center py-16" style="background-image: url('/images/lesson_bg.png');">
      <div class="max-w-6xl mx-auto px-4">
        <div class="text-center text-white text-lg mb-2 tracking-widest">FAQ</div>
        <div class="text-center text-white text-5xl font-bold mb-12 tracking-wider">QUESTIONS</div>
        <div class="grid md:grid-cols-3 gap-8 text-white">
          <div v-for="(faq, idx) in faqs" :key="faq.question" class="mb-4">
            <div
              class="font-bold pt-5 pb-5 text-base flex items-center cursor-pointer select-none border-t border-b border-white"
              @click="toggle(idx)"
            >
              <span>{{ faq.question }}</span>
              <svg
                :class="['ml-2 transition-transform', openIndex === idx ? 'rotate-180' : 'rotate-0']"
                width="20" height="20" fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.085l3.71-3.855a.75.75 0 111.08 1.04l-4.24 4.4a.75.75 0 01-1.08 0l-4.24-4.4a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
              </svg>
            </div>
            <div v-show="openIndex === idx" class="text-sm transition-all duration-300 pt-5 pb-5">
              {{ faq.answer }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- -->
    <section class="w-full border ">
  <div class="max-w-3xl mx-auto flex flex-col items-center justify-center py-16">
    <!-- 日历图标 -->
    <svg class="w-14 h-14 text-[#22336a] mb-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
      <rect x="3" y="5" width="18" height="16" rx="2" stroke="currentColor" fill="none"/>
      <path d="M16 3v4M8 3v4M3 9h18" stroke="currentColor"/>
    </svg>
    <!-- 主标题 -->
    <h1 class="text-4xl md:text-5xl font-extrabold text-[#1a2233] text-center mb-2">
      Book a Survival Chinese lesson now
    </h1>
    <!-- 副标题 -->
    <div class="text-xl font-semibold text-[#1a2233] text-center mb-6">
      (1 hr/50 USD)
    </div>
    <!-- 描述文字 -->
    <p class="text-lg text-[#2d3a4a] text-center max-w-2xl">
      Scheduling your lesson is easy with my user-friendly online calendar. Simply choose a time that fits your schedule and begin your learning journey right away! After booking, you'll receive an email with payment instructions. A Zoom link will be sent separately before your lesson begins.
    </p>
  </div>
</section>
    <!-- 课程预约 -->
    <section ref="bookingSectionRef" class="flex justify-center items-start py-16 bg-white">
      <div class="w-full max-w-4xl flex shadow-lg rounded-lg overflow-hidden bg-white">
        <!-- 步骤侧边栏 -->
        <div class="w-64 bg-[#1a2950] text-white py-8 px-4 flex flex-col gap-4">
          <div
            v-for="(step, idx) in steps"
            :key="step.key"
            class="flex items-center gap-2 py-3 px-2 rounded transition"
            :class="{
              'bg-[#22336a] font-bold': currentStep === idx,
              'opacity-60': idx > maxStep
            }"
          >
            <span v-if="step.icon" v-html="step.icon" class="text-xl"></span>
            <span>{{ step.label }}</span>
            <span v-if="step.info" class="ml-auto text-xs text-[#a0e0ff]">{{ step.info }}</span>
            <span v-if="step.done" class="ml-auto text-green-400">✔</span>
          </div>
        </div>
        <!-- 主体内容 -->
        <div class="flex-1 bg-white p-8 min-h-[500px]">
          <!-- 步骤1：选择日期 -->
          <div v-if="currentStep === 0">
            <div class="text-xl font-bold mb-4">Date & Time</div>
            <div v-if="!selectedDate">
              <Calendar v-model="selectedDate" />
            </div>
            <div v-else>
              <div class="flex items-center justify-between mb-4">
                <div class="text-lg">
                  Selected Date: <span class="font-semibold">{{ selectedDate }}</span>
                </div>
              
              </div>
              <TimeSlotSelector
                v-model="selectedTime"
                :selected-date="selectedDate"
              />
              <div class="mt-8 flex justify-between">
                <button class="px-6 py-2 border rounded" @click="selectedDate = ''">Back</button>
                <button
                  class="px-6 py-2 bg-[#3487fe] text-white rounded"
                  :disabled="!selectedTime"
                  @click="nextStep"
                >Continue</button>
              </div>
            </div>
          </div>
          <!-- 步骤2：选择时间段 -->
          <div v-else-if="currentStep === 1">
            <div class="text-xl font-bold mb-4">Recurring Appointment</div>
            <div class="flex items-center gap-4 mb-4">
              <span>Repeat every</span>
              <input type="number" min="1" v-model.number="repeatEvery" class="border rounded px-2 py-1 w-16" />
              <select v-model="repeatUnit" class="border rounded px-2 py-1">
                <option value="day">day</option>
                <option value="week">week</option>
              </select>
            </div>
            <div class="mb-4">
              <span>Ends:</span>
              <label class="ml-4">
                <input type="radio" v-model="repeatEndType" value="date" />
                <span class="ml-1">On</span>
                <input
                  type="date"
                  v-model="repeatEndDate"
                  :disabled="repeatEndType !== 'date'"
                  class="border rounded px-2 py-1 ml-2"
                />
              </label>
              <label class="ml-4">
                <input type="radio" v-model="repeatEndType" value="count" />
                <span class="ml-1">After</span>
                <input
                  type="number"
                  min="1"
                  v-model.number="repeatCount"
                  :disabled="repeatEndType !== 'count'"
                  class="border rounded px-2 py-1 ml-2 w-16"
                />
                <span class="ml-1">Occurrences</span>
              </label>
            </div>
            <div class="mt-8 flex justify-between">
              <button class="px-6 py-2 border rounded" @click="prevStep">Back</button>
              <button class="px-6 py-2 bg-[#3487fe] text-white rounded" @click="nextStep">Continue</button>
            </div>
          </div>
          <!-- 步骤3：选择天数和是否重复 -->
          <div v-else-if="currentStep === 2">
            <div class="text-xl font-bold mb-4">Recurring Appointment</div>
            <div class="flex items-center gap-4 mb-4">
              <span>Repeat every</span>
              <input type="number" min="1" v-model.number="every_date" class="border rounded px-2 py-1 w-16" />
              <select v-model="repeatUnit" class="border rounded px-2 py-1">
                <option value="day">day</option>
                <option value="week">week</option>
              </select>
            </div>
            <div class="mb-4">
              <span>Ends:</span>
              <label class="ml-4">
                <input type="radio" v-model="endType" value="date" />
                <span class="ml-1">On</span>
                <input
                  type="date"
                  v-model="end_date"
                  :disabled="endType !== 'date'"
                  class="border rounded px-2 py-1 ml-2"
                />
              </label>
              <label class="ml-4">
                <input type="radio" v-model="endType" value="count" />
                <span class="ml-1">After</span>
                <input
                  type="number"
                  min="1"
                  v-model.number="recursion_number"
                  :disabled="endType !== 'count'"
                  class="border rounded px-2 py-1 ml-2 w-16"
                />
                <span class="ml-1">Occurrences</span>
              </label>
            </div>
            <div class="mt-8 flex justify-between">
              <button class="px-6 py-2 border rounded" @click="prevStep">Back</button>
              <button class="px-6 py-2 bg-[#3487fe] text-white rounded" @click="nextStep">Continue</button>
            </div>
          </div>
          <!-- 步骤4：填写用户信息 -->
          <div v-else-if="currentStep === 3">
            <div class="text-xl font-bold mb-4">Your Information</div>
            <form @submit.prevent="submitUserInfo" class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block mb-1 font-semibold">First Name *</label>
                <input v-model="userInfo.firstName" class="border rounded px-2 py-1 w-full" required />
                <div v-if="firstNameError" class="text-red-500 text-xs mt-1">{{ firstNameError }}</div>
              </div>
              <div>
                <label class="block mb-1 font-semibold">Last Name *</label>
                <input v-model="userInfo.lastName" class="border rounded px-2 py-1 w-full" required />
                <div v-if="lastNameError" class="text-red-500 text-xs mt-1">{{ lastNameError }}</div>
              </div>
              <div>
                <label class="block mb-1 font-semibold">Email *</label>
                <input v-model="userInfo.email" type="email" class="border rounded px-2 py-1 w-full" required />
                <div v-if="emailError" class="text-red-500 text-xs mt-1">{{ emailError }}</div>
              </div>
              <div>
                <label class="block mb-1 font-semibold">Phone</label>
                <VueTelInput
                  v-model="userInfo.phone"
                  :inputoptions="telInputOptions"
                  :preferred-countries="preferredCountries"
                  :show-search-box="true"
                  class="w-full"
                  @validate="onPhoneInput"
                />
                <div v-if="phoneError" class="text-red-500 text-xs mt-1">{{ phoneError }}</div>
              </div>
            </form>
            <div class="mt-8 flex justify-between">
              <button class="px-6 py-2 border rounded" @click="prevStep">Back</button>
              <button
                class="px-6 py-2 bg-[#3487fe] text-white rounded"
                @click="submitUserInfo"
              >Continue</button>
            </div>
          </div>
          <!-- 步骤5：订单确认和支付 -->
          <div v-else-if="currentStep === 4">
            <div class="text-2xl font-extrabold mb-6 text-[#22336a] text-center tracking-wide">Order Confirmation</div>
            <div class="bg-white rounded-xl shadow-lg p-8 max-w-lg mx-auto mb-8 border border-gray-100">
              <!-- 服务信息 -->
              <div class="flex items-center justify-between mb-6 pb-2 border-b">
                <span class="font-semibold text-gray-600">Service</span>
                <span class="font-bold text-[#3487fe]">Survival Chinese Lesson</span>
              </div>
              <!-- 时间信息 -->
              <div class="grid grid-cols-2 gap-x-6 gap-y-3 mb-6">
                <div>
                  <div class="text-xs text-gray-400">Date</div>
                  <div class="font-medium text-gray-800">{{ selectedDate }}</div>
                </div>
                <div>
                  <div class="text-xs text-gray-400">Time</div>
                  <div class="font-medium text-gray-800">{{ selectedTime }}</div>
                </div>
                <div class="col-span-2">
                  <div class="text-xs text-gray-400">Repeat</div>
                  <div class="font-medium text-gray-800">{{ repeatSummary }}</div>
                </div>
              </div>
              <!-- 用户信息 -->
              <div class="grid grid-cols-2 gap-x-6 gap-y-3 mb-6">
                <div>
                  <div class="text-xs text-gray-400">Name</div>
                  <div class="font-medium text-gray-800">{{ userInfo.firstName }} {{ userInfo.lastName }}</div>
                </div>
                <div>
                  <div class="text-xs text-gray-400">Email</div>
                  <div class="font-medium text-gray-800">{{ userInfo.email }}</div>
                </div>
                <div class="col-span-2">
                  <div class="text-xs text-gray-400">Phone</div>
                  <div class="font-medium text-gray-800">{{ userInfo.phone }}</div>
                </div>
              </div>
              <!-- 总价 -->
              <div class="flex items-center justify-between border-t pt-4 mt-2">
                <span class="text-lg font-bold text-[#22336a]">Total</span>
                <span class="text-2xl font-extrabold text-[#3487fe]">${{ totalPrice }}</span>
              </div>
            </div>
            <div class="flex justify-center mb-4">
              <button
                class="flex items-center gap-2 px-8 py-2 bg-[#3487fe] text-white rounded font-bold shadow hover:bg-blue-700 transition"
                @click="submitReservation"
              >
                <i class="fab fa-paypal text-2xl"></i>
                Pay with PayPal
              </button>
            </div>
            <div class="flex justify-between max-w-lg mx-auto">
              <button class="px-6 py-2 border rounded" @click="prevStep">Back</button>
            </div>
          </div>
          <!-- 步骤6：完成页面 -->
          <div v-else-if="currentStep === 5" class="flex flex-col items-center justify-center h-full">
            <div class="text-3xl font-bold text-[#3487fe] mb-4">Congratulations</div>
            <div class="mb-2">Your appointment has been booked successfully!</div>
            <div class="mb-2">A confirmation email has been sent to <b>{{ userInfo.email }}</b></div>
            <button class="mt-6 px-8 py-2 bg-[#3487fe] text-white rounded" @click="resetAll">Book Another</button>
          </div>
        </div>
      </div>
    </section>
  </div>
  </div>

  <!-- 静态弹窗 -->
  <div v-if="showLessonModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
    <div class="bg-transparent rounded-lg shadow-lg p-0 w-full max-w-4xl relative">
      <button class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl z-10" @click="showLessonModal = false">&times;</button>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 p-8">
        <!-- 卡片1 -->
        <div class="rounded-2xl overflow-hidden shadow-lg bg-white flex flex-col h-full">
          <div class="h-40 bg-cover bg-center flex items-center justify-center" style="background-image:url('/images/lessons/a.png')"></div>
          <div class="flex-1 flex flex-col items-center justify-center p-6">
            <div class="text-lg font-bold mb-2">One trial class</div>
            <div class="text-2xl text-[#003a8c] font-bold mb-2">45 USD</div>
            <div class="text-gray-500 mb-2">45 mins</div>
            <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded mt-2 transition" @click="openCardForm(1)">Select</button>
          </div>
        </div>
        <!-- 卡片2 -->
        <div class="rounded-2xl overflow-hidden shadow-lg bg-white flex flex-col h-full">
          <div class="h-40 bg-cover bg-center flex items-center justify-center" style="background-image:url('/images/lessons/c.png')"></div>
          <div class="flex-1 flex flex-col items-center justify-center p-6">
            <div class="text-lg font-bold mb-2">Class hour package（6 lessons）</div>
            <div class="text-2xl text-[#003a8c] font-bold mb-2">40 USD/45 mins</div>
            <div class="text-gray-500 mb-2">45 mins</div>
            <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded mt-2 transition" @click="openCardForm(2)">Select</button>
          </div>
        </div>
        <!-- 卡片3 -->
        <div class="rounded-2xl overflow-hidden shadow-lg bg-white flex flex-col h-full">
          <div class="h-40 bg-cover bg-center flex items-center justify-center" style="background-image:url('/images/lessons/b.png')"></div>
          <div class="flex-1 flex flex-col items-center justify-center p-6">
            <div class="text-lg font-bold mb-2">I want to study regularly</div>
            <div class="text-gray-700 mb-2">Every class <span class="text-[#003a8c] font-bold">38 USD</span> / 45 mins</div>
            <button @click="scrollToBooking" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded mt-2 transition">Select</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 选择卡片1/2弹出表单静态框 -->
  <div v-if="showCardForm" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md relative">
      <button class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl z-10" @click="showCardForm = false">&times;</button>
      <form @submit.prevent="submitCardForm">
        <div v-if="coursePackage==1" class="rounded-2xl overflow-hiddenflex flex-col h-full">
          <div class="h-40 w-full flex items-center justify-center ">
            <img src="/images/lessons/a.png" alt="" class="h-full max-h-40 w-auto object-contain" />
          </div>
          <div class="flex-1 flex flex-col items-center justify-center p-6">
            <div class="text-lg font-bold mb-2">One trial class</div>
            <div class="text-2xl text-[#003a8c] font-bold mb-2">45 USD</div>
            <div class="text-gray-500 mb-2">45 mins</div>
                  <span>The course package will be sent to you by email. Please make sure to fill in your email address and check it!!</span>
          </div>
        </div>
        <!-- 卡片2 -->
        <div  v-if="coursePackage==2"  class="rounded-2xl overflow-hidden  flex flex-col h-full">
          <div class="h-40 w-full flex items-center justify-center ">
            <img src="/images/lessons/c.png" alt="" class="h-full max-h-40 w-auto object-contain" />
          </div>
          <div class="flex-1 flex flex-col items-center justify-center p-6">
            <div class="text-lg font-bold mb-2">Class hour package（6 lessons）</div>
            <div class="text-2xl text-[#003a8c] font-bold mb-2">40 USD/45 mins</div>
            <div class="text-gray-500 mb-2">45 mins</div>
            <span>The course package will be sent to you by email. Please make sure to fill in your email address and check it!!</span>
          </div>
        </div>
        <div class="mb-4">
          <label class="block mb-1 font-semibold">Name *</label>
          <input v-model="cardForm.name" class="border rounded px-2 py-2 w-full" />
          <div v-if="cardFormErrors.name" class="text-red-500 text-xs mt-1">{{ cardFormErrors.name }}</div>
        </div>
        <div class="mb-4">
          <label class="block mb-1 font-semibold">Email *</label>
          <input v-model="cardForm.email" class="border rounded px-2 py-2 w-full" type="email" />
          <div v-if="cardFormErrors.email" class="text-red-500 text-xs mt-1">{{ cardFormErrors.email }}</div>
        </div>
        <div class="mb-6">
          <label class="block mb-1 font-semibold">Phone *</label>
          <input v-model="cardForm.phone" class="border rounded px-2 py-2 w-full" />
          <div v-if="cardFormErrors.phone" class="text-red-500 text-xs mt-1">{{ cardFormErrors.phone }}</div>
        </div>
        <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 rounded flex items-center justify-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M22.5 6.5a2.5 2.5 0 0 0-2.5-2.5h-16A2.5 2.5 0 0 0 1.5 6.5v11A2.5 2.5 0 0 0 4 20h16a2.5 2.5 0 0 0 2.5-2.5v-11ZM4 5h16a1.5 1.5 0 0 1 1.5 1.5V8H2.5V6.5A1.5 1.5 0 0 1 4 5Zm16 14H4A1.5 1.5 0 0 1 2.5 17.5V9H21.5v8.5A1.5 1.5 0 0 1 20 19Z"/><path d="M7.5 15.5a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 1 0v2a.5.5 0 0 1-.5.5Zm3.5 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 1 0v2a.5.5 0 0 1-.5.5Zm3.5 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 1 0v2a.5.5 0 0 1-.5.5Z"/></svg>
          Pay with PayPal
        </button>
      </form>
    </div>
  </div>
</Layout>
</template>

<script setup>
import Layout from '@/Layouts/App.vue'
import { usePage } from '@inertiajs/vue3'
import { ref, computed, onMounted, nextTick, watch } from 'vue'
import axios from 'axios'
import Swal from 'sweetalert2'
import { VueTelInput } from 'vue-tel-input'
import 'vue-tel-input/vue-tel-input.css';
import Calendar from '@/Components/Calendar.vue'
import TimeSlotSelector from '@/Components/TimeSlotSelector.vue'

const { lesson } = usePage().props

const { config } = usePage().props

// 步骤栏
const steps = [
  { key: 'date', label: 'Date & Time', icon: '📅' },
  { key: 'time', label: 'Select Time', icon: '⏰' },
  { key: 'repeat', label: 'Recurring Appointment', icon: '🔁' },
  { key: 'info', label: 'Your Information', icon: '👤' },
  { key: 'confirm', label: 'Payments', icon: '💳' },
]
const currentStep = ref(0)
const maxStep = ref(5)

// 日历相关
const today = new Date()
const calendarYear = ref(today.getFullYear())
const calendarMonth = ref(today.getMonth())
const selectedDate = ref('')
const calendarCells = ref([])
const timeSlots = ref([])

async function fetchCalendarData() {
  try {
    const response = await axios.get('/api/calendar-data', {
      params: {
        year: calendarYear.value,
        month: calendarMonth.value + 1
      }
    })
    calendarCells.value = response.data.days
    timeSlots.value = response.data.time_slots
  } catch (error) {
    console.error('Failed to fetch calendar data:', error)
  }
}

// 监听年月变化
watch([calendarYear, calendarMonth], () => {
  fetchCalendarData()
})

onMounted(() => {
  fetchCalendarData()
})

function selectDate(date) {
  selectedDate.value = date
}

// 时间段
const selectedTime = ref('')
function selectTime(slot) {
  selectedTime.value = slot
}

// 重复预约
const repeatEvery = ref(1)
const repeatUnit = ref('day')
const repeatEndType = ref('count')
const repeatEndDate = ref('')
const repeatCount = ref(1)

// 用户信息
const userInfo = ref({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
})
const firstNameError = ref('')
const lastNameError = ref('')
const emailError = ref('')
const phoneError = ref('')
const phoneDialCode = ref('')

const telInputOptions = {
  showDialCode: true,
  placeholder: 'Enter your phone number',
  defaultCountry: 'cn'
}
const preferredCountries = ['cn', 'us', 'gb', 'au']

function onPhoneInput(value, info) {
  if (!info) {
    phoneError.value = 'Invalid phone number'
    phoneDialCode.value = ''
    return
  }
  if (!info.valid) {
    phoneError.value = 'Invalid phone number'
  } else {
    phoneError.value = ''
  }
  console.log('info:', info)
  if (info.country && info.country.dialCode) {
    phoneDialCode.value = `+${info.country.dialCode}`
  } else if (info.dialCode) {
    phoneDialCode.value = `+${info.dialCode}`
  } else {
    phoneDialCode.value = ''
  }
}

function validateUserInfo() {
  firstNameError.value = ''
  lastNameError.value = ''
  emailError.value = ''
  phoneError.value = ''

  // 姓名校验
  if (!userInfo.value.firstName) {
    firstNameError.value = 'First name is required'
  }
  if (!userInfo.value.lastName) {
    lastNameError.value = 'Last name is required'
  }

  // 邮箱校验
  if (!userInfo.value.email) {
    emailError.value = 'Email is required'
  } else if (!/^[\w\-\.]+@[\w\-]+\.[\w\-]+$/.test(userInfo.value.email)) {
    emailError.value = 'Invalid email format'
  }

  // 电话校验
  if (!userInfo.value.phone) {
    phoneError.value = 'Phone is required'
  } // 不再用正则，onPhoneInput 已处理格式

  return !firstNameError.value && !lastNameError.value && !emailError.value && !phoneError.value
}

// 价格
const totalPrice = computed(() => {
  // 50美元/节，乘以次数
  return 50 * (repeatEndType.value === 'count' ? repeatCount.value : 1)
})

// 步骤切换
function nextStep() {
  if (currentStep.value < 5) currentStep.value++
}
function prevStep() {
  if (currentStep.value > 0) currentStep.value--
}
function submitUserInfo() {
  if (validateUserInfo()) {
    nextStep()
  }
}

async function submitReservation() {
  const payload = {
    course_id: lesson.id,
    first_name: userInfo.value.firstName,
    last_name: userInfo.value.lastName,
    email: userInfo.value.email,
    phone: userInfo.value.phone,
    phone_dial_code: phoneDialCode.value,
    start_time: selectedDate.value + ' ' + (selectedTime.value ? selectedTime.value.split(' - ')[0] : ''),
    end_time: selectedDate.value + ' ' + (selectedTime.value ? selectedTime.value.split(' - ')[1] : ''),
    every_date: every_date.value,
    end_date: endType.value === 'date' ? end_date.value : null,
    recursion_number: endType.value === 'count' ? recursion_number.value : null,
    pay_price: totalPrice.value,
  }
  try {
    // 提交预约
    const res = await axios.post('/api/course-reservation', payload)
    const orderNo = res.data.order_no

    // 调用后端生成 PayPal 支付链接
    const payRes = await axios.post('/api/paypal/pay', { order_no: orderNo })
    if (payRes.data.paypal_url) {
      // 跳转到 PayPal 支付
      window.location.href = payRes.data.paypal_url
    } else {
      Swal.fire({ icon: 'error', title: 'Payment failed', text: 'Failed to obtain the payment link' })
    }
  } catch (e) {
    Swal.fire({ icon: 'error', title: 'Operation failure', text: 'The reservation or payment failed. Please try again' })
  }
}

function pay() {
  // 这里可集成 PayPal 支付
  nextStep()
}
function resetAll() {
  currentStep.value = 0
  selectedDate.value = ''
  selectedTime.value = ''
  every_date.value = 1
  repeatUnit.value = 'day'
  endType.value = 'count'
  end_date.value = ''
  recursion_number.value = 1
  userInfo.value = { firstName: '', lastName: '', email: '', phone: '' }
}

// 新增ref
const bookingSectionRef = ref(null)

// 滚动函数
function scrollToBooking() {
  showLessonModal.value = false
  bookingSectionRef.value?.scrollIntoView({ behavior: 'smooth' })
}

onMounted(() => {
  // 检查 URL 参数，支付成功后自动跳到完成页
  const params = new URLSearchParams(window.location.search)
  if (params.get('step') == 6 && params.get('course_type') != 0) {
    Swal.fire({
        icon: 'success',
        title: 'Payment Success',
        text: 'The payment was successful. Please check your email',
        confirmButtonColor: '#3487fe'
      })

  }
  if (params.get('step') == 6 && params.get('course_type') == 0) {
    currentStep.value = 5
    // 滚动到预约部分
    nextTick(() => {
      scrollToBooking()
    })
  }
})

const faqs = [
  {
    question: "Who are these lessons ideal for?",
    answer: "These lessons are perfect for travelers, expatriates, or anyone who needs to quickly acquire basic Chinese language skills for everyday situations."
  },
  {
    question: "What kind of topics will I learn in Survival Chinese?",
    answer: "You'll learn essential phrases and vocabulary for daily life, such as ordering food, asking for directions, shopping, and basic greetings."
  },
  {
    question: "How fast can I expect to learn the basics?",
    answer: "With regular practice, most students can grasp the essentials within a few weeks, making them comfortable with basic interactions in Chinese."
  },
  {
    question: "Do I need prior Chinese knowledge to take these lessons?",
    answer: "No prior knowledge is required. These lessons are designed for complete beginners who want to quickly acquire practical language skills."
  },
  {
    question: "Will I learn any cultural tips along with the language?",
    answer: "Yes, our lessons include cultural insights to help you navigate social situations and understand local customs better."
  },
  {
    question: "Can these lessons be customized for specific travel needs?",
    answer: "Absolutely! We can tailor the lessons to focus on scenarios you are likely to encounter, such as hotel check-ins, transportation, and emergency situations."
  },
  // ... 其余 FAQ
]

const openIndex = ref(null)
const toggle = idx => {
  openIndex.value = openIndex.value === idx ? null : idx
}

const showLessonModal = ref(false)
const weeklyLessons = ref(2)
const selectedDays = ref([])

const showCardForm = ref(false)
const cardFormTitle = ref('')
const cardForm = ref({
  name: 'PL',
  email: '2540463097@qq.com',
  phone: '13217025359',
})
const coursePackage = ref(1)
const cardFormErrors = ref({})

function openCardForm(cardIndex) {

  coursePackage.value = cardIndex

  showLessonModal.value = false
  cardFormTitle.value = cardIndex === 1 ? 'One trial class' : 'Class hour package（6 lessons）'
  showCardForm.value = true
}

async function submitCardForm() {
  cardFormErrors.value = {}

  if (!cardForm.value.name) {
    cardFormErrors.value.name = 'Name is required'
  }
  if (!cardForm.value.email) {
    cardFormErrors.value.email = 'Email is required'
  }
  if (!cardForm.value.phone) {
    cardFormErrors.value.phone = 'Phone is required'
  }

  if (Object.keys(cardFormErrors.value).length > 0) {
    return
  }

  try {
    // 1. 创建订单
    const res = await axios.post('/api/course-reservation/purchase-course-packages', {
      name: cardForm.value.name,
      email: cardForm.value.email,
      phone: cardForm.value.phone,
      package_type: coursePackage.value, // 1 or 2
      course_id: lesson.id,
    })
    const orderNo = res.data.order_no

    // 2. 拉起 PayPal 支付
    const payRes = await axios.post('/api/paypal/pay', { order_no: orderNo })
    if (payRes.data.paypal_url) {
      window.location.href = payRes.data.paypal_url
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Payment Failed',
        text: 'Failed to get PayPal payment link',
        confirmButtonColor: '#3487fe'
      })
    }
    showCardForm.value = false
  } catch (e) {
    Swal.fire({
      icon: 'error',
      title: 'Operation Failed',
      text: 'Order creation or payment failed, please try again',
      confirmButtonColor: '#3487fe'
    })
  }
}

// 当日期改变时，清空已选择的时间
watch(selectedDate, () => {
  selectedTime.value = ''
})

// 在 script setup 部分添加新的响应式变量
const every_date = ref(1)
const end_date = ref('')
const recursion_number = ref(1)
const endType = ref('count')

// 修改 repeatSummary computed 属性
const repeatSummary = computed(() => {
  if (endType.value === 'date' && end_date.value) {
    return `Repeat every ${every_date.value} ${repeatUnit.value}(s) until ${end_date.value}`
  } else {
    return `Repeat every ${every_date.value} ${repeatUnit.value}(s), ${recursion_number.value} times`
  }
})
</script>

