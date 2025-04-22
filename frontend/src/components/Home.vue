<script setup>

</script>

<template>

  <div class="min-h-screen bg-yellow-50 flex justify-center p-4">
    <div class="text-center">
      <h1 class="text-5xl font-extrabold text-red-600 drop-shadow-md mb-8 mt-64">Bienvenue chez McBo</h1>
      <div class="justify-center bg-yellow-50 mb-8">
        <font-awesome-icon icon="arrow-down" class="text-5xl text-red-600 animate-bounce" />
      </div>
      <RouterLink to="/article" class="bg-red-600 text-white px-6 py-3 rounded-2xl shadow-lg text-lg hover:bg-red-700 transition font-bold">
        Commander Maintenant
      </RouterLink>
    </div>
  </div>
</template>
