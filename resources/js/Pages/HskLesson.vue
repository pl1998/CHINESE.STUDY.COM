<template>
  <div class="min-h-screen bg-white">
    <!-- 导航栏 -->
    <Navbar />
    <div class="pt-[88px]">
    <!-- 课程介绍主区域 -->
    <div class="w-full bg-[#eaf2f3] py-12 mt-30">
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
          <button
            class="bg-[#6ec1e4] text-white px-8 py-2 rounded font-semibold hover:bg-[#009FE8] transition text-lg shadow-md"
            @click="scrollToBooking"
          >book now</button>
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
            <div class="flex items-center gap-4 mb-6">
              <select v-model="calendarMonth" class="border rounded px-2 py-1">
                <option v-for="(m, i) in months" :key="i" :value="i">{{ m }}</option>
              </select>
              <select v-model="calendarYear" class="border rounded px-2 py-1">
                <option v-for="y in years" :key="y" :value="y">{{ y }}</option>
              </select>
              <span class="text-xs text-gray-500">Asia/Shanghai</span>
            </div>
            <div class="grid grid-cols-7 gap-2 text-center">
              <div v-for="d in weekDays" :key="d" class="font-semibold text-gray-600">{{ d }}</div>
              <template v-for="cell in calendarCells">
                <button
                  v-if="cell"
                  :key="cell.date"
                  class="py-2 rounded transition border"
                  :class="{
                    'bg-[#eaf2f3] text-gray-400 cursor-not-allowed': cell.disabled,
                    'bg-[#3487fe] text-white font-bold border-[#3487fe]': selectedDate === cell.date,
                    'hover:bg-[#eaf2f3]': !cell.disabled && selectedDate !== cell.date
                  }"
                  :disabled="cell.disabled"
                  @click="selectDate(cell.date)"
                >{{ cell.day }}</button>
                <div v-else :key="Math.random()"></div>
              </template>
            </div>
            <div class="mt-8 flex justify-end">
              <button
                class="px-6 py-2 bg-[#3487fe] text-white rounded"
                :disabled="!selectedDate"
                @click="nextStep"
              >Continue</button>
            </div>
          </div>
          <!-- 步骤2：选择时间段 -->
          <div v-else-if="currentStep === 1">
            <div class="text-xl font-bold mb-4">Select Time Slot</div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
              <button
                v-for="slot in timeSlots"
                :key="slot"
                class="py-2 rounded border transition"
                :class="{
                  'bg-[#3487fe] text-white font-bold border-[#3487fe]': selectedTime === slot,
                  'hover:bg-[#eaf2f3]': selectedTime !== slot
                }"
                @click="selectTime(slot)"
              >{{ slot }}</button>
            </div>
            <div class="mt-8 flex justify-between">
              <button class="px-6 py-2 border rounded" @click="prevStep">Back</button>
              <button
                class="px-6 py-2 bg-[#3487fe] text-white rounded"
                @click="nextStep"
              >Continue</button>
            </div>
          </div>
          <!-- 步骤3：选择天数和是否重复 -->
          <div v-else-if="currentStep === 2">
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

    <!-- 页脚 -->
    <Footer />
  </div>
  </div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue'
import Footer from '../components/Footer.vue'
import { ref, computed, onMounted, nextTick } from 'vue'
import axios from 'axios'
import Swal from 'sweetalert2'
import { VueTelInput } from 'vue-tel-input'
import 'vue-tel-input/vue-tel-input.css';

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
const months = ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月']
const years = Array.from({length: 2}, (_,i)=>today.getFullYear()+i)
const weekDays = ['周一','周二','周三','周四','周五','周六','周日']

function getCalendarCells() {
  const firstDay = new Date(calendarYear.value, calendarMonth.value, 1)
  const lastDay = new Date(calendarYear.value, calendarMonth.value + 1, 0)
  const startDay = (firstDay.getDay() + 6) % 7 // 以周一为第一天
  const days = []
  for (let i = 0; i < startDay; i++) days.push(null)
  for (let d = 1; d <= lastDay.getDate(); d++) {
    const dateStr = `${calendarYear.value}-${String(calendarMonth.value+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`
    const dateObj = new Date(calendarYear.value, calendarMonth.value, d)
    const isDisabled = dateObj <= today
    days.push({
      day: d,
      date: dateStr,
      disabled: isDisabled,
    })
  }
  return days
}
const calendarCells = computed(getCalendarCells)
function selectDate(date) {
  selectedDate.value = date
}

// 时间段
const timeSlots = [
  '12:00 - 13:00', '12:30 - 13:30', '13:00 - 14:00',
  '15:00 - 16:00', '15:30 - 16:30', '16:00 - 17:00',
  '16:30 - 17:30', '17:00 - 18:00', '17:30 - 18:30',
  '18:30 - 19:30', '18:00 - 19:00', '19:30 - 20:30',
  '21:00 - 22:00', '21:30 - 22:30', '22:00 - 23:00',
  '22:30 - 23:00'
]
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
const repeatSummary = computed(() => {
  if (repeatEndType.value === 'date' && repeatEndDate.value) {
    return `Repeat every ${repeatEvery.value} ${repeatUnit.value}(s) until ${repeatEndDate.value}`
  } else {
    return `Repeat every ${repeatEvery.value} ${repeatUnit.value}(s), ${repeatCount.value} times`
  }
})

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
  // 构造要提交的数据
  const payload = {
    first_name: userInfo.value.firstName,
    last_name: userInfo.value.lastName,
    email: userInfo.value.email,
    phone: userInfo.value.phone,
    phone_dial_code: phoneDialCode.value,
    start_time: selectedDate.value + ' ' + (selectedTime.value ? selectedTime.value.split(' - ')[0] : ''),
    end_time: selectedDate.value + ' ' + (selectedTime.value ? selectedTime.value.split(' - ')[1] : ''),
    repeat: repeatSummary.value,
    pay_price: totalPrice.value,
  }
  try {
    // 1. 提交预约，生成订单
    const res = await axios.post('/api/course-reservation', payload)
    const orderNo = res.data.order_no

    // 2. 调用后端生成 PayPal 支付链接
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
  repeatEvery.value = 1
  repeatUnit.value = 'day'
  repeatEndType.value = 'count'
  repeatEndDate.value = ''
  repeatCount.value = 1
  userInfo.value = { firstName: '', lastName: '', email: '', phone: '' }
}

// 新增ref
const bookingSectionRef = ref(null)

// 滚动函数
function scrollToBooking() {
  bookingSectionRef.value?.scrollIntoView({ behavior: 'smooth' })
}

onMounted(() => {
  // 检查 URL 参数，支付成功后自动跳到完成页
  const params = new URLSearchParams(window.location.search)
  if (params.get('step') == 6) {
    currentStep.value = 5
    // 滚动到预约部分
    nextTick(() => {
      scrollToBooking()
    })
  }
})
</script>

