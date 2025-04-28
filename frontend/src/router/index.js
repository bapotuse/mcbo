import { createRouter, createWebHistory } from 'vue-router'
import Home from "../components/Home.vue";
import Login from "../components/Login.vue";
import Register from "../components/Register.vue";
import Article from "../components/Article.vue";
import Compte from "../components/Compte.vue";
import Cart from "../components/Cart.vue";
import ArticleDetail from '../components/ArticleDetail.vue';

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
  },
  {
    path: '/panier',
    name: 'Cart',
    component: Cart
  },
  {
    path: '/article/:id',
    name: 'ArticleDetail',
    component: ArticleDetail
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router 
