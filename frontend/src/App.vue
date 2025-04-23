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
        <img src="../src/assets/vraiMcbo.png" width="80" class="items-center"/>
      </RouterLink>

      <div class="flex flex-1 items-center justify-end md:justify-between">
        <nav aria-label="Global" class="hidden md:block">
          <ul class="flex items-center gap-6 text-sm">
            <li>
              <RouterLink to="/article" class="text-gray-500 transition hover:text-gray-500/75">Articles</RouterLink>
            </li>
            <li>
              <RouterLink to="/panier" class="flex items-center text-gray-500 transition hover:text-gray-500/75">
                <span>Panier</span>
                <span v-if="itemCount > 0" class="ml-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs text-white">
                  {{ itemCount }}
                </span>
              </RouterLink>
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
          </div>

          <button
              class="block rounded-sm bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden"
          >
            <span class="sr-only">Toggle menu</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </header>

  <RouterView />
</template>
