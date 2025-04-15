import { createRouter, createWebHistory } from 'vue-router'
import Home from "../components/Home.vue";
import Login from "../components/Login.vue";
import Register from "../components/Register.vue";
import Article from "../components/Article.vue";
import Compte from "../components/Compte.vue";

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
    path: '/article',
    name: 'Article',
    component: Article
  },
  {
    path: '/mon-compte',
    name: 'Compte',
    component: Compte
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router 