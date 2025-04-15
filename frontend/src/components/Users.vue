<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const users = ref([]);

onMounted(async () => {
  const response = await axios.get("http://localhost/mcdo/backend/users.php");
  users.value = response.data;
});
</script>

<template>
  <div>
    <h1>Liste des utilisateurs</h1>
    <ul>
      <li v-for="user in users" :key="user.id">
        {{ user.nom }} - {{ user.mail }} - {{ user.prenom }} - {{ user.adresse }} - {{ user.telephone }} - {{ user.mot_de_passe }}
      </li>
    </ul>
  </div>
</template>
