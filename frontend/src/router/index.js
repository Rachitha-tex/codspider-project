import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../views/HomePage.vue'
import CategoryView from '../components/CategoryView.vue'
import ProductView from '../components/ProductView.vue'


const routes = [
  {
    path: '/',
    name: 'HomePage',
    component: HomePage
  },

  {
    path: '/category',
    name: 'CategoryView',
    component: CategoryView
  },
  {
    path: '/product',
    name: 'ProductView',
    component: ProductView
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
