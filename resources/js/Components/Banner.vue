<template>
  <div class="w-full h-[400px] overflow-hidden">
    <img 
      :src="imageSrc" 
      :alt="alt" 
      class="w-full h-full object-cover object-center"
    />
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