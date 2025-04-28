<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { ref, onMounted } from 'vue'
import { useCart } from './composables/useCart'

const isLoggedIn = ref(false)
const { itemCount } = useCart()

onMounted(() => {
  isLoggedIn.value = localStorage.getItem("isLoggedIn") === "true"
})


</script>

<template>
  <header class="bg-white">
    <div class="mx-auto flex h-16 max-w-screen-xl items-center gap-8 px-4 sm:px-6 lg:px-8">
      <RouterLink to="/" class="block text-teal-600">
        <span class="sr-only">Home</span>
        <img src="../src/assets/mcboLogo.png" width="50" class="items-center rounded-lg"/>
      </RouterLink>

      <div class="flex flex-1 items-center justify-end md:justify-between">
        <nav class="hidden md:block">
          <ul class="flex items-center gap-6 text-md">
            <li>
              <RouterLink to="/article" class="text-gray-500 font-bold transition hover:text-gray-500/75">Articles</RouterLink>
            </li>
          </ul>
        </nav>

        <div class="flex items-center gap-4">
          <div class="sm:flex sm:gap-4">
            <template v-if="isLoggedIn">
              <RouterLink to="/mon-compte" class="block rounded-md bg-teal-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700">
                Mon compte
              </RouterLink>
            </template>

            <template v-else>
              <RouterLink to="/login" class="block rounded-md bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-red-700">
                Se connecter
              </RouterLink>

              <RouterLink to="/register" class="hidden rounded-md bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-red-700 sm:block">
                S'inscrire
              </RouterLink>
            </template>
            <RouterLink to="/panier" class="flex items-center text-gray-500 transition hover:text-gray-500/75">
                 <font-awesome-icon icon="cart-shopping" />
                <span v-if="itemCount > 0" class="ml-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs text-white">
                  {{ itemCount }}
                </span>
              </RouterLink>
          </div>
        </div>
      </div>
    </div>
  </header>

  <RouterView />
</template>
