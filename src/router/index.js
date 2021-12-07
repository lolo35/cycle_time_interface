import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../views/Home.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  // {
  //   path: '/about',
  //   name: 'About',
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  // }
  {
    path: "/amg1",
    name: "AMG1",
    component: () => import('../views/AMG1.vue'),
  },
  {
    path: "/amg2",
    name: "AMG2",
    component: () => import('../views/AMG2.vue'),
  },
  {
    path: "/amg3",
    name: "AMG3",
    component: () => import('../views/AMG3.vue'),
  },
  {
    path: "/amg4",
    name: "AMG4",
    component: () => import('../views/AMG4.vue'),
  },
  {
    path: "/amg5",
    name: "AMG5",
    component: () => import('../views/AMG5.vue'),
  },
  {
    path: "/amg6",
    name: "AMG6",
    component: () => import('../views/AMG6.vue'),
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
