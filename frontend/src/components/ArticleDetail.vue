<script setup>
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const article = ref(null)

onMounted(async () => {
  const response = await axios.get(`http://localhost/mcdo/backend/article_detail.php?id=${route.params.id}`)
  article.value = response.data
})
</script>

<template>
  <div v-if="article" class="max-w-xl mx-auto p-6 bg-white shadow rounded">
    <img :src="article.image" alt="Image" class="w-full h-64 object-cover mb-4 rounded" />
    <h2 class="text-2xl font-bold mb-2">{{ article.nom }}</h2>
    <p class="text-gray-700 mb-2">{{ article.description }}</p>
    <p class="text-lg font-semibold text-red-600">{{ article.prix }} €</p>
  </div>
  <div v-else class="text-center mt-10">Chargement...</div>
</template>
