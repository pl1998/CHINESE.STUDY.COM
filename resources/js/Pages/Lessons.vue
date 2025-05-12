<template>
<Layout :config="config">
  <div class="bg-white pt-[112px]">
    <div>
       <!-- 顶部大图 -->
       <div class="w-full">
          <Banner imageSrc="/images/banner/lesson.jpg" alt="Lessons Banner" />
        </div>
    <!-- <div class="w-full h-[260px] md:h-[320px] bg-gray-200">
      <img
        src="/images/banner/lesson.jpg"
        alt="about-banner"
        class="w-full h-full object-cover"
      />
    </div> -->
      <div class="max-w-6xl mx-auto w-full px-4 py-8">
           <!-- 面包屑导航 -->
           <div class="w-full bg-[#f7f7f7] py-2 px-4 text-sm text-gray-600">
            Home &gt;&gt; <span class="text-[#009FE8]">1V1 LESSON</span>
          </div>
          <!-- 课程内容区域 -->
          <section v-if="courses && courses.data" class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 py-8 px-4">
            <Link
              v-for="item in courses.data"
              :key="item.id"
              :href="`/hsk-lesson/${item.id}`"
              class="relative group border-2 border-white hover:border-[#009FE8] transition rounded block"
            >
              <img :src="item.cover" :alt="item.name" class="w-full h-56 object-cover rounded" />
              <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-white text-center px-4">
                <div class="text-2xl font-bold mb-2">{{ item.name }}</div>
                <div class="text-base font-semibold">{{ item.description }}</div>
              </div>
            </Link>
          </section>
          <div v-else class="text-center text-gray-400 py-8">No courses available at the moment</div>
          <!-- 分页 -->
          <div class="flex justify-center gap-2 py-8">
            <template v-for="page in courses.links" :key="page.label">
              <Link
                v-if="page.url"
                :href="page.url"
                v-html="page.label"
                :class="['px-3 py-1 rounded', { 'bg-[#009FE8] text-white': page.active, 'text-gray-500': !page.active }]"
                preserve-scroll
              />
              <span
                v-else
                v-html="page.label"
                class="px-3 py-1 rounded text-gray-300 cursor-not-allowed"
              />
            </template>
          </div>
    </div>
    </div>
      </div>
</Layout>
</template>
<script setup>
import Layout from '@/Layouts/App.vue'
import { Link, usePage } from '@inertiajs/vue3'
import Banner from '@/Components/Banner.vue'

const { config } = defineProps({
  config: {
    type: Object,
    required: true
  }
})

const { courses } = usePage().props
</script>
