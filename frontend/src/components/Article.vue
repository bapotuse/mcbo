<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const articles = ref([]);

onMounted(async () => {
  try {
    const response = await axios.get("http://127.0.0.1/mcdo/backend/article.php", {
      withCredentials: true
    });
    console.log("Réponse reçue :", response.data);
    articles.value = response.data;
  } catch (error) {
    console.error("Erreur Axios :", error);
  }
});

</script>

<template>
<h1 class="text-center text-3xl font-bold my-6">Liste des articles</h1>



<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 p-6">
  <div v-for="article in articles" :key="article.id" class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow">
    <img :src="article.image" alt="Produit" class="w-full h-52 object-cover">
    <div class="p-4">
      <h3 class="text-xl font-semibold text-gray-800">{{ article.nom }}</h3>
      <p class="text-gray-500 mt-1">{{ article.description }}</p>
      <div class="mt-4 flex justify-between items-center">
        <span class="text-lg font-bold text-red-600">{{ article.prix }} €</span>
        <button class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded-md transition-colors">Ajouter</button>
      </div>
    </div>
  </div>
</div>

    
</template>

