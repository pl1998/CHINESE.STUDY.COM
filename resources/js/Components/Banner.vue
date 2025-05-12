<template>
  <div class="w-full">
    <img :src="imageSrc" :alt="alt" class="w-full object-cover" style="height: 400px;" />
  </div>
</template>

<script setup>
defineProps({
  imageSrc: {
    type: String,
    required: true
  },
  alt: {
    type: String,
    default: 'Banner'
  }
})
</script> 