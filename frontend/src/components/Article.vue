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



<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
  <!-- Carte produit -->
  <div v-for="article in articles" :key="article.id" class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow">
    <img src="https://via.placeholder.com/400x250" alt="Produit" class="w-full h-52 object-cover">
    <div class="p-4">
      <h3 class="text-xl font-semibold text-gray-800">{{ article.nom }}</h3>
      <p class="text-gray-500 mt-1">{{ article.description }}</p>
      <div class="mt-4 flex justify-between items-center">
        <span class="text-lg font-bold text-green-600">{{ article.prix }} €</span>
        <button class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full transition-colors">Ajouter</button>
      </div>
    </div>
  </div>
</div>

    
</template>

