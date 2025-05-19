<template>
  <footer class="bg-white border-t border-gray-200 py-8">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 px-4 text-sm">
      <div>
        <img src="/images/logo/logo.png" alt="logo" class="h-20 mb-2" />
        <div class="text-gray-500">Copyright © 2025. All rights reserved.<br />ELENA MANDARIN</div>
        <div class="flex space-x-4 mt-2">
          <a :href="config.instagram_url" target="_blank" class="text-gray-400 hover:text-[#009FE8] transition-colors">
            <font-awesome-icon :icon="['fab', 'instagram']" class="text-xl" />
          </a>
          <a :href="config.tiktok_url" target="_blank" class="text-gray-400 hover:text-[#009FE8] transition-colors">
            <font-awesome-icon :icon="['fab', 'tiktok']"  class="text-xl"/>
          </a>
          <a :href="config.youtube_url" target="_blank" class="text-gray-400 hover:text-[#009FE8] transition-colors">
            <font-awesome-icon :icon="['fab', 'youtube']" class="text-xl" />
          </a>
        </div>
      </div>
      <div>
        <div class="font-bold mb-2">Site Navigation</div>
        <ul class="space-y-1">
          <li><Link href="/" :class="{ 'text-[#009FE8]': $page.url === '/' }">Home</Link></li>
          <li><Link href="/lessons" :class="{ 'text-[#009FE8]': $page.url === '/lessons' }">1V1 LESSON</Link></li>
          <li><Link href="/recorded" :class="{ 'text-[#009FE8]': $page.url === '/recorded' }">Recorded Lesson</Link></li>
          <li><Link href="/practice" :class="{ 'text-[#009FE8]': $page.url === '/practice' }">Daily Practice</Link></li>
          <li><Link href="/about" :class="{ 'text-[#009FE8]': $page.url === '/about' }">About Me</Link></li>
          <li><Link href="/contact" :class="{ 'text-[#009FE8]': $page.url === '/contact' }">Contact</Link></li>
        </ul>
      </div>
      <div>
        <div class="font-bold mb-2">1V1 LESSON</div>
        <ul class="space-y-1">
          <li><Link href="/lessons">hsk-1-6</Link></li>
          <li><Link href="/lessons">survival chinese</Link></li>
          <li><Link href="/lessons">conversational chinese</Link></li>
          <li><Link href="/lessons">Fun Chinese Debate Topics</Link></li>
        </ul>
      </div>
      <div>
        <div class="font-bold mb-2">Newsletter</div>
        <div class="text-gray-500 mb-2">We love sharing tips, resources and stories to help Chinese language learners just like you. Subscribe and learn with us!</div>
        <form @submit.prevent="handleSubmit" class="flex space-x-2">
          <input 
            v-model="email" 
            type="email" 
            placeholder="Submit Now" 
            class="flex-1 border border-gray-300 rounded px-2 py-1 focus:outline-none focus:border-[#009FE8]" 
          />
          <button type="submit" class="bg-[#009FE8] text-white px-4 py-1 rounded hover:bg-[#007bb5]">Submit</button>
        </form>
      </div>
    </div>
    <div class="text-center text-gray-400 text-xs mt-6">Copyright @ 2025 . All rights reserved. ELENA MANDARIN</div>
  </footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import axios from 'axios'
import Swal from 'sweetalert2'


const props = defineProps({
  config: {
    type: Object,
    required: true,
    default: () => ({
      instagram_url: '#',
      tiktok_url: '#',
      youtube_url: '#'
    })
  }
})

const email = ref('')
const handleSubmit = async () => {
  try {
    const response = await axios.post('/api/subscribe', {
      email: email.value
    })
    if (response.data.status == 200) {
      Swal.fire({ icon: 'success', title: 'Subscription successful', text: 'Welcome to subscribe. We will push the first consultation to you immediately' })
      email.value = ''
    } else {
      Swal.fire({ icon: 'error', title: 'Order failure', text: response.data.message })
    }
  } catch (error) {
    Swal.fire({ icon: 'error', title: 'Order failure', text: 'Please enter the correct email address' })
  }
}
</script>