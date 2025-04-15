<script setup>
import { ref } from "vue";

const mail = ref("");
const mot_de_passe = ref("");
const message = ref("");

const handleRegister = async () => {
  try {
    const response = await fetch("http://localhost/backend/register.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        mail: mail.value,
        mot_de_passe: mot_de_passe.value,
      }),
    });

    const result = await response.json();
    if (result.success) {
      message.value = "Inscription réussie !";
    } else {
      message.value = result.error || "Une erreur est survenue.";
    }
  } catch (error) {
    message.value = "Erreur de connexion au serveur.";
  }
};
</script>

<template>
  <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded">
    <h1 class="text-2xl font-bold mb-4">Inscription</h1>
    <form @submit.prevent="handleRegister">
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Mail</label>
        <input
            type="email"
            id="mail"
            v-model="mail"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            required
        />
      </div>
      <div class="mb-4">
        <label for=" " class="block text-sm font-medium text-gray-700">Mot de passe</label>
        <input
            type="password"
            id="mot_de_passe"
            v-model="mot_de_passe"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            required
        />
      </div>
      <button
          type="submit"
          class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
      >
        S'inscrire
      </button>
    </form>
    <p v-if="message" class="mt-4 text-center text-sm text-red-500">{{ message }}</p>
  </div>
</template>

<style scoped>
/* Ajoutez des styles personnalisés ici si nécessaire */
</style>