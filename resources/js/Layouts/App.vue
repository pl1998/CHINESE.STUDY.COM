<template>
    <div>
    <Navbar :config="config" />
    <slot></slot>
    <Footer :config="config" />
  </div>
  </template>
  <script setup>
  import Navbar from '@/Components/Navbar.vue'
  import Footer from '@/Components/Footer.vue'
  defineProps({
    config: {
      type: Object,
      required: true,
      default: () => ({
        ipone: '',
        email: '',
        instagram_url: '#',
        tiktok_url: '#',
        youtube_url: '#'
      })
    }
  })
  </script>