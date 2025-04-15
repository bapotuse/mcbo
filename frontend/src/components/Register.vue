<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()

const nom = ref('')
const prenom = ref('')
const email = ref('')
const motDePasse = ref('')
const adresse = ref('')
const telephone = ref('')
const erreur = ref('')
const succes = ref('')

const inscrire = async () => {
  try {
    const response = await axios.post('http://localhost/mcdo/backend/register.php', {
      nom: nom.value,
      prenom: prenom.value,
      email: email.value,
      mot_de_passe: motDePasse.value,
      adresse: adresse.value,
      telephone: telephone.value
    })

    if (response.data.success) {
      window.location.href = '/'
    } else {
      erreur.value = response.data.message
    }
  } catch (err) {
    erreur.value = "Une erreur est survenue."
    console.error(err)
  }
}
</script>

<template>
  <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-center">Inscription</h2>

    <div v-if="erreur" class="text-red-500 mb-3">{{ erreur }}</div>
    <div v-if="succes" class="text-red-500 mb-3">{{ succes }}</div>

    <form @submit.prevent="inscrire">

      <div class="mb-4">
        <label class="block text-gray-700 mb-1">Nom</label>
        <input v-model="nom" type="text" required class="w-full border rounded p-2" />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 mb-1">Prénom</label>
        <input v-model="prenom" type="text" required class="w-full border rounded p-2" />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 mb-1">Email</label>
        <input v-model="email" type="email" required class="w-full border rounded p-2" />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 mb-1">Numéro de Téléphone</label>
        <input v-model="telephone" type="text" required class="w-full border rounded p-2" />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 mb-1">Adresse</label>
        <input v-model="adresse" type="text" required class="w-full border rounded p-2" />
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 mb-1">Mot de passe</label>
        <input v-model="motDePasse" type="password" required class="w-full border rounded p-2" />
      </div>

      <button type="submit" class="w-full bg-teal-600 text-white py-2 rounded hover:bg-teal-700 transition">
        S'inscrire
      </button>
    </form>
  </div>
</template>
