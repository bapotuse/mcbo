<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useCart } from "../composables/useCart";

const articles = ref([]);
const { addToCart } = useCart();

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



<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 p-4 mx-64">
  <div 
    v-for="article in articles" 
    :key="article.id" 
    class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow w-full"
  >
    <img 
      :src="article.image" 
      alt="Produit" 
      class="w-full h-48 object-cover"
    >
    <div class="p-3">
      <h3 class="text-lg font-semibold text-gray-800 truncate">{{ article.nom }}</h3>
      <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ article.description }}</p>
      <div class="mt-2 flex justify-between items-center">
        <span class="text-base font-bold text-red-600">{{ article.prix }} €</span>
        <button 
          @click="addToCart(article)" 
          class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1.5 rounded-md"
        >
          Ajouter
        </button>
        <RouterLink
          :to="`/article/${article.idArticle}`"
          class="text-blue-600 hover:underline text-sm mt-2 block"
        >
          Voir détails
        </RouterLink>
      </div>
    </div>
  </div>
</div>



</template>
