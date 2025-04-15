<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const articles = ref([]);

onMounted(async () => {
  const response = await axios.get("http://localhost/mcdo/backend/article.php");
  articles.value = response.data;
});
</script>

<template>
<div class="text-center text-3xl font-bold my-6">Liste des articles</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-4">
  <div
    v-for="article in articles"
    :key="article.id"
    class="bg-white rounded-2xl shadow-md p-5 hover:shadow-xl transition duration-300"
  >
    <div class="text-xl font-semibold text-gray-800 mb-2">
      {{ article.nom }}
    </div>
    <div class="text-green-600 font-bold text-lg mb-1">
      {{ article.prix }} €
    </div>
    <div class="text-gray-600 text-sm">
      {{ article.description }}
    </div>
  </div>
</div>

    
</template>

