<script setup>
import { ref } from 'vue'
import axios from 'axios'

const email = ref('')
const motDePasse = ref('')
const erreur = ref('')

const seConnecter = async () => {
  try {
    const response = await axios.post('http://localhost/mcdo/backend/login.php', {
      email: email.value,
      mot_de_passe: motDePasse.value
    })

    if (response.data.success) {
      localStorage.setItem("isLoggedIn", "true"),
      localStorage.setItem("prenom", response.data.prenom)
      localStorage.setItem("nom", response.data.nom)
      localStorage.setItem("mail", response.data.mail)
      localStorage.setItem("idClient", response.data.idClient)
      window.location.href = '/article'
    } else {
      erreur.value = response.data.message
    }
  } catch (error) {
    console.log(error)
  }
}
</script>

<template>
  <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-center">Connexion</h2>
    
    <div v-if="erreur" class="text-red-500 mb-3">{{ erreur }}</div>

    <form @submit.prevent="seConnecter">
      <div class="mb-4">
        <label class="block text-gray-700 mb-1">Email</label>
        <input v-model="email" type="email" required class="w-full border rounded p-2" />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 mb-1">Mot de passe</label>
        <input v-model="motDePasse" type="password" required class="w-full border rounded p-2" />
      </div>

      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
        Se connecter
      </button>
    </form>
  </div>
</template>
