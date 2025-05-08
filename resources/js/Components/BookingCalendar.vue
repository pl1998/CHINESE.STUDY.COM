<template>
  <div class="bg-white rounded shadow p-8 max-w-3xl mx-auto">
    <!-- 步骤指示 -->
    <div class="flex justify-between mb-8">
      <div v-for="(label, idx) in steps" :key="idx" class="flex-1 text-center">
        <div :class="['w-8 h-8 mx-auto rounded-full flex items-center justify-center mb-1', step === idx ? 'bg-[#009FE8] text-white' : 'bg-gray-200 text-gray-500']">{{ idx+1 }}</div>
        <div :class="step === idx ? 'text-[#009FE8] font-bold' : 'text-gray-500'">{{ label }}</div>
      </div>
    </div>

    <!-- 步骤1：选择日期 -->
    <div v-if="step === 0">
      <div class="text-lg font-bold mb-2">选择上课日期</div>
      <div class="grid grid-cols-7 gap-2">
        <div
          v-for="date in calendarDates"
          :key="date.value"
          :class="[
            'py-2 text-center rounded cursor-pointer',
            date.disabled ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : (selectedDate === date.value ? 'bg-[#009FE8] text-white font-bold' : 'bg-white hover:bg-blue-50')
          ]"
          @click="!date.disabled && selectDate(date.value)"
        >
          {{ date.label }}
        </div>
      </div>
      <button class="mt-6 px-6 py-2 bg-[#009FE8] text-white rounded" :disabled="!selectedDate" @click="nextStep">下一步</button>
    </div>

    <!-- 步骤2：选择时间段 -->
    <div v-else-if="step === 1">
      <div class="text-lg font-bold mb-2">选择上课时间段</div>
      <div class="grid grid-cols-2 gap-3">
        <button
          v-for="slot in timeSlots"
          :key="slot"
          :class="['py-2 rounded border', selectedTime === slot ? 'bg-[#009FE8] text-white border-[#009FE8]' : 'bg-white text-gray-700 border-gray-200 hover:bg-blue-50']"
          @click="selectTime(slot)"
        >{{ slot }}</button>
      </div>
      <button class="mt-6 px-6 py-2 bg-[#009FE8] text-white rounded" :disabled="!selectedTime" @click="nextStep">下一步</button>
    </div>

    <!-- 步骤3：选择天数和是否重复 -->
    <div v-else-if="step === 2">
      <div class="text-lg font-bold mb-2">选择天数与是否重复</div>
      <div class="mb-4">
        <label class="mr-2">上课天数：</label>
        <input type="number" v-model.number="repeatDays" min="1" max="30" class="border rounded px-2 py-1 w-20" />
      </div>
      <div class="mb-4">
        <label class="mr-2">是否每天重复：</label>
        <input type="checkbox" v-model="isRepeat" />
      </div>
      <button class="mt-6 px-6 py-2 bg-[#009FE8] text-white rounded" @click="nextStep">下一步</button>
    </div>

    <!-- 步骤4：填写用户信息 -->
    <div v-else-if="step === 3">
      <div class="text-lg font-bold mb-2">填写用户信息</div>
      <form @submit.prevent="validateUserInfo">
        <div class="mb-3">
          <input v-model="userInfo.name" type="text" placeholder="姓名" class="border rounded px-2 py-1 w-full" required />
        </div>
        <div class="mb-3">
          <input v-model="userInfo.email" type="email" placeholder="邮箱" class="border rounded px-2 py-1 w-full" required />
        </div>
        <div class="mb-3">
          <input v-model="userInfo.phone" type="text" placeholder="手机号" class="border rounded px-2 py-1 w-full" required />
        </div>
        <button class="mt-4 px-6 py-2 bg-[#009FE8] text-white rounded" type="submit">下一步</button>
      </form>
      <div v-if="userError" class="text-red-500 mt-2">{{ userError }}</div>
    </div>

    <!-- 步骤5：订单确认与支付 -->
    <div v-else-if="step === 4">
      <div class="text-lg font-bold mb-2">订单确认</div>
      <div class="mb-2">日期：{{ selectedDate }}</div>
      <div class="mb-2">时间段：{{ selectedTime }}</div>
      <div class="mb-2">天数：{{ repeatDays }}</div>
      <div class="mb-2">是否重复：{{ isRepeat ? '是' : '否' }}</div>
      <div class="mb-2">姓名：{{ userInfo.name }}</div>
      <div class="mb-2">邮箱：{{ userInfo.email }}</div>
      <div class="mb-2">手机号：{{ userInfo.phone }}</div>
      <div class="mb-4 font-bold text-lg">总价：${{ totalPrice }}</div>
      <!-- PayPal 按钮占位 -->
      <button class="px-6 py-2 bg-yellow-400 text-black rounded" @click="payOrder">Pay with PayPal</button>
    </div>

    <!-- 步骤6：完成页面 -->
    <div v-else-if="step === 5">
      <div class="text-2xl font-bold text-green-600 mb-4">预约成功！</div>
      <div class="mb-2">感谢您的预约，支付已完成。</div>
      <div class="mb-2">我们会通过邮箱发送上课链接，请注意查收。</div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

// 步骤
const step = ref(0)
const steps = ['选择日期', '选择时间', '天数/重复', '用户信息', '订单支付', '完成']

// 日历相关
const today = new Date()
const calendarDates = Array.from({ length: 14 }, (_, i) => {
  const d = new Date(today)
  d.setDate(today.getDate() + i)
  return {
    label: `${d.getMonth() + 1}/${d.getDate()}`,
    value: d.toISOString().slice(0, 10),
    disabled: i === 0 // 今天不可选
  }
})
const selectedDate = ref('')

// 时间段
const timeSlots = [
  '09:00-10:00', '10:00-11:00', '11:00-12:00',
  '14:00-15:00', '15:00-16:00', '16:00-17:00',
  '19:00-20:00', '20:00-21:00'
]
const selectedTime = ref('')

// 重复
const repeatDays = ref(1)
const isRepeat = ref(false)

// 用户信息
const userInfo = ref({ name: '', email: '', phone: '' })
const userError = ref('')

// 订单
const totalPrice = computed(() => 50 * repeatDays.value)
const payed = ref(false)

// 步骤切换
function nextStep() {
  step.value++
}
function selectDate(val) {
  selectedDate.value = val
}
function selectTime(val) {
  selectedTime.value = val
}
function validateUserInfo() {
  userError.value = ''
  if (!userInfo.value.name || !userInfo.value.email || !userInfo.value.phone) {
    userError.value = '请填写完整信息'
    return
  }
  // 简单邮箱校验
  if (!/^[\w.-]+@[\w.-]+\.\w+$/.test(userInfo.value.email)) {
    userError.value = '邮箱格式不正确'
    return
  }
  nextStep()
}
function payOrder() {
  // 这里应集成 PayPal 支付，演示直接跳转
  step.value++
}
</script> 