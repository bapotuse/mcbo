import { createRouter, createWebHistory } from 'vue-router'
import Home from "../components/Home.vue";
import Login from "../components/Login.vue";
import Users from "../components/Users.vue";
import Register from "../components/Register.vue";

const routes = [
  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/users',
    name: 'Users',
    component: Users
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router 