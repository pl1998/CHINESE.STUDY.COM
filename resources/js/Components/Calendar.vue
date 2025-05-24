<template>
  <div class="calendar-container">
    <!-- 年月选择器 -->
    <div class="flex items-center gap-4 mb-6">
      <select v-model="calendarMonth" class="border rounded px-2 py-1">
        <option v-for="(m, i) in months" :key="i" :value="i">{{ m }}</option>
      </select>
      <select v-model="calendarYear" class="border rounded px-2 py-1">
        <option v-for="y in years" :key="y" :value="y">{{ y }}</option>
      </select>
      <span class="text-xs text-gray-500">Time zone（UTC）</span>
    </div>

    <!-- 日历网格 -->
    <div class="grid grid-cols-7 gap-2 text-center">
      <!-- 星期标题 -->
      <div v-for="d in weekDays" :key="d" class="font-semibold text-gray-600">{{ d }}</div>
      
      <!-- 日期单元格 -->
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
  </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue'
import axios from 'axios'

const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  }
})

const emit = defineEmits(['update:modelValue'])

// 日历相关
const today = new Date()
const calendarYear = ref(today.getFullYear())
const calendarMonth = ref(today.getMonth())
const selectedDate = ref(props.modelValue)
const months = ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月']
const years = Array.from({length: 2}, (_,i)=>today.getFullYear()+i)
const weekDays = ['周一','周二','周三','周四','周五','周六','周日']
const calendarCells = ref([])

// 监听选中日期变化
watch(selectedDate, (newValue) => {
  emit('update:modelValue', newValue)
})

// 监听年月变化
watch([calendarYear, calendarMonth], () => {
  fetchCalendarData()
})

async function fetchCalendarData() {
  try {
    const response = await axios.get('/api/calendar-data', {
      params: {
        year: calendarYear.value,
        month: calendarMonth.value + 1
      }
    })
    calendarCells.value = response.data.days
  } catch (error) {
    console.error('Failed to fetch calendar data:', error)
  }
}

function selectDate(date) {
  selectedDate.value = date
}

onMounted(() => {
  fetchCalendarData()
})
</script>

<style scoped>
.calendar-container {
  @apply bg-white p-4 rounded-lg shadow;
}
</style> 