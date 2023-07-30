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
      path: '/member-info',
      name: 'member-info',
      component: () => import('@/views/pages/member/MemberInfo.vue')
    },
    {
      path: '/thanks-letter',
      name: 'thanks-letter',
      component: () => import('@/views/pages/member/thanksLetter.vue')
    },
    {
      path: '/news',
      name: 'news',
      component: () => import('@/views/pages/news/News.vue')
    },
    {
      path: '/sponsor-location',
      name: 'sponsor-project',
      component: () => import('@/views/pages/sponsor/SponsorProject.vue')
    },
    {
      path: '/sponsor-order',
      name: 'sponsor-order',
      component: () => import('@/views/pages/sponsor/SponsorOrder.vue')
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
    {
      path: '/spark-activity',
      name: 'spark-activity',
      component: () => import('@/views/pages/activity/SparkActivity.vue')
    },
    {
      path: '/dream-star',
      name: 'dream-star',
      component: () => import('@/views/pages/activity/DreamStar.vue')
    },
    {
      path: '/dream-star-vote',
      name: 'dream-star-vote',
      component: () => import('@/views/pages/activity/DreamStarVote.vue')
    },
    {
      path: '/message-board',
      name: 'message-board',
      component: () => import('@/views/pages/activity/MessageBoard.vue')
    },
    {
      path: '/story',
      name: 'story',
      component: () => import('@/views/pages/results/story.vue')
    },
    {
      path: '/reports',
      name: 'reports',
      component: () => import('@/views/pages/results/Reports.vue')
    },
    {
      path: '/milestone',
      name: 'milestone',
      component: () => import('@/views/pages/results/Milestone.vue')
    },
    {
      path: '/cms-staff',
      name: 'cms-staff',
      component: () => import('@/views/pages/activity/CmsStaff.vue')
    },
  ]
})

export default router
