<script setup>
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const article = ref(null)

onMounted(async () => {
  try {
    const response = await axios.get(`http://localhost/mcdo/backend/article_detail.php?id=${route.params.id}`)
    console.log('Réponse du backend:', response.data)  // Vérifie ce qui est renvoyé par le backend
    article.value = response.data
  } catch (error) {
    console.error('Erreur Axios:', error)
  }
})
</script>

<template>
  <div v-if="article" class="max-w-xl mx-auto p-6 bg-white shadow rounded">
    <!-- Vérifie si l'image existe -->
    <img :src="article.image || 'default-image.jpg'" alt="Image" class="w-full h-64 object-cover mb-4 rounded" />
    <h2 class="text-2xl font-bold mb-2">{{ article.nom || 'Nom de l\'article indisponible' }}</h2>
    <p class="text-gray-700 mb-2">{{ article.description || 'Aucune description disponible' }}</p>
    <p class="text-lg font-semibold text-red-600">{{ article.prix ? `${article.prix} €` : 'Prix non disponible' }}</p>
  </div>
  <div v-else class="text-center mt-10">Chargement...</div>
</template>
