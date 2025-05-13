<template>
  <div class="w-full bg-[#f7f7f7] py-2 px-4 text-sm text-gray-600">
    <Link href="/" class="text-[#009FE8] hover:underline">Home</Link>
    <span> &gt;&gt; </span>
    <span>{{ current }}</span>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({
  current: {
    type: String,
    required: true
  }
})
</script>
