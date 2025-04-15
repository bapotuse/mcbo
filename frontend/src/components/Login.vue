<script setup>
import { ref } from "vue";

const email = ref("");
const password = ref("");

const handleLogin = () => {
  // Logique de connexion (exemple : appel API)
  console.log("Email:", email.value);
  console.log("Password:", password.value);
};
</script>

<template>
  <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded">
    <h1 class="text-2xl font-bold mb-4">Connexion</h1>
    <form @submit.prevent="handleLogin">
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input
          type="email"
          id="email"
          v-model="email"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
          required
        />
      </div>
      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
        <input type="password" id="password" v-model="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required />
      </div>
      <button
        type="submit"
        class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
      >
        Se connecter
      </button>
    </form>
  </div>
</template>

<style scoped>
</style>