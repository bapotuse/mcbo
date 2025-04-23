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
  <div class="flex flex-col items-center mt-32 px-6 py-8 mx-auto md:h-screen lg:py-0">
      <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                  Connectez-vous à votre compte
              </h1>
              <div v-if="erreur" class="text-red-500 mb-3">{{ erreur }}</div>
              <form @submit.prevent="seConnecter" class="space-y-4 md:space-y-6" action="#">
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                      <input v-model="email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="exemple@test.com" required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Mot de passe</label>
                      <input v-model="motDePasse" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " required="">
                  </div>
                  <button type="submit" class="w-full text-white bg-[#fca81c] hover:cursor-pointer hover:bg-[#e89613] focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Connexion</button>
                  <p class="text-sm text-gray-500 ">
                      Vous n'avez pas encore de compte? <RouterLink to="/register" class="font-medium text-primary-600 hover:underline">Inscrivez-vous</RouterLink>
                  </p>
              </form>
          </div>
      </div>
  </div>
</template>
