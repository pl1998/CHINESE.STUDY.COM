<template>
    <Layout :config="config">
 
    </Layout>
  </template>
  
  <script setup>
  import Layout from '@/Layouts/App.vue'
  import { Link, usePage } from '@inertiajs/vue3'
  import { library } from '@fortawesome/fontawesome-svg-core'
  import { faVolumeUp } from '@fortawesome/free-solid-svg-icons'
  library.add(faVolumeUp)
  const { level_label } = usePage().props
  defineProps({
    config: {
      type: Object,
      required: true
    }
  })
  </script>