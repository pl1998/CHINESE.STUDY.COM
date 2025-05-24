<template>
  <div class="time-slot-selector">
    <div class="grid grid-cols-4 gap-4">
      <button
        v-for="slot in timeSlots"
        :key="slot.time"
        class="p-1 rounded text-center transition-colors"
        :class="{
          'bg-[#3487fe] text-white': modelValue === slot.time,
          'hover:bg-gray-50': !slot.disabled && modelValue !== slot.time,
          'bg-gray-100 text-gray-400 cursor-not-allowed': slot.disabled
        }"
        :disabled="slot.disabled"
        @click="!slot.disabled && $emit('update:modelValue', slot.time)"
      >
        {{ slot.time }}
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import axios from 'axios'

const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  },
  selectedDate: {
    type: String,
    required: true
  }
})

const emit = defineEmits(['update:modelValue'])
const timeSlots = ref([])

const fetchTimeSlots = async () => {
  try {
    const response = await axios.get(`/api/time-slots?date=${props.selectedDate}`)
    timeSlots.value = response.data.time_slots
  } catch (error) {
    console.error('Failed to fetch time slots:', error)
    timeSlots.value = []
  }
}

// 监听日期变化
watch(() => props.selectedDate, (newDate) => {
  if (newDate) {
    fetchTimeSlots()
  } else {
    timeSlots.value = []
  }
}, { immediate: true })

// 当日期改变时，清空已选择的时间
watch(() => props.selectedDate, () => {
  emit('update:modelValue', '')
})
</script>

<style scoped>
.time-slot-selector {
  max-width: 600px;
  margin: 0 auto;
}
</style> 