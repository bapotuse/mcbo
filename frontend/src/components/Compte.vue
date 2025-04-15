<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const nom = ref('')
const prenom = ref('')
const mail = ref('')

onMounted(() => {
  const isLoggedIn = localStorage.getItem('isLoggedIn')
  if (isLoggedIn !== 'true') {
    router.push('/login')
  } else {
    nom.value = localStorage.getItem('nom')
    prenom.value = localStorage.getItem('prenom')
    mail.value = localStorage.getItem('mail')
  }
})
</script>

<template>
  <div class="max-w-lg mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4 text-center text-teal-600">Mon compte</h2>

    <div class="space-y-3">
      <p><span class="font-semibold text-gray-700">Prénom :</span> {{ prenom }}</p>
      <p><span class="font-semibold text-gray-700">Nom :</span> {{ nom }}</p>
      <p><span class="font-semibold text-gray-700">Mail :</span> {{ mail }}</p>
    </div>
  </div>
</template>
