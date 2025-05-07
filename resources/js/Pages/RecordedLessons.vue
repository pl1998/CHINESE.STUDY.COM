<template>
  <div class="min-h-screen bg-gray-50">
    <Header />
    
    <main class="py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">录播课程</h1>
        
        <!-- 课程列表 -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="course in courses" :key="course.id" 
               class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="relative">
              <img :src="course.image" :alt="course.title" class="w-full h-48 object-cover">
              <div class="absolute top-2 right-2 bg-indigo-600 text-white px-2 py-1 rounded">
                {{ course.level }}
              </div>
            </div>
            <div class="p-6">
              <h2 class="text-xl font-bold text-gray-900">{{ course.title }}</h2>
              <p class="mt-2 text-gray-600">{{ course.description }}</p>
              <div class="mt-4 flex items-center justify-between">
                <span class="text-2xl font-bold text-indigo-600">${{ course.price }}</span>
                <button 
                  @click="purchaseCourse(course)"
                  class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700"
                >
                  立即购买
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import Header from '@/Components/Header.vue';

const courses = ref([
  {
    id: 1,
    title: 'HSK1-2 基础课程',
    description: '零基础入门课程，掌握基本会话和语法',
    price: 99,
    level: '入门级',
    image: '/images/courses/hsk-basic.jpg'
  },
  {
    id: 2,
    title: 'HSK3-4 进阶课程',
    description: '进阶课程，提升口语和写作能力',
    price: 149,
    level: '中级',
    image: '/images/courses/hsk-intermediate.jpg'
  },
  {
    id: 3,
    title: '商务中文',
    description: '职场必备的商务中文表达',
    price: 199,
    level: '高级',
    image: '/images/courses/business-chinese.jpg'
  }
]);

const purchaseCourse = (course) => {
  // TODO: 实现购买逻辑
};
</script> 