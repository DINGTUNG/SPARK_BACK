import { createRouter, createWebHistory } from 'vue-router'
import Login from '@/views/Login.vue'
import Home from '@/views/Home.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: Login
    },
    {
      path: '/home',
      name: 'home',
      component: Home
    },
    {
      path: '/donate-project',
      name: 'donate-project',
      component: () => import('@/views/pages/donate/DonateProject.vue')
    },
    {
      path: '/donate-order',
      name: 'donate-order',
      component: () => import('@/views/pages/donate/DonateOrder.vue')
    },
  ]
})

export default router
