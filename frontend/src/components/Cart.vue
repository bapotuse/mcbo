<script setup>
import { useCart } from "../composables/useCart";

const { cartItems, removeFromCart, updateQuantity, totalPrice, clearCart } = useCart();
</script>

<template>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-center text-3xl font-bold my-6">Mon Panier</h1>

    <div v-if="cartItems.length === 0" class="text-center py-10">
      <p class="text-gray-500 text-xl">Votre panier est vide</p>
      <RouterLink to="/article" class="mt-4 inline-block bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md transition-colors">
        Voir les articles
      </RouterLink>
    </div>

    <div v-else>
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <table class="w-full">
          <thead>
            <tr class="border-b">
              <th class="text-left py-4">Produit</th>
              <th class="text-center py-4">Quantité</th>
              <th class="text-right py-4">Prix</th>
              <th class="text-right py-4">Total</th>
              <th class="text-right py-4">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in cartItems" :key="item.id" class="border-b">
              <td class="py-4">
                <div class="flex items-center">
                  <div>
                    <h3 class="font-semibold text-gray-800">{{ item.nom }}</h3>
                    <p class="text-gray-500 text-sm">{{ item.description }}</p>
                  </div>
                </div>
              </td>
              <td class="py-4">
                <div class="flex items-center justify-center">
                  <button 
                    @click="updateQuantity(item.id, item.quantity - 1)"
                    class="bg-gray-200 px-2 py-1 rounded-l"
                  >
                    -
                  </button>
                  <span class="px-4">{{ item.quantity }}</span>
                  <button 
                    @click="updateQuantity(item.id, item.quantity + 1)"
                    class="bg-gray-200 px-2 py-1 rounded-r"
                  >
                    +
                  </button>
                </div>
              </td>
              <td class="py-4 text-right">{{ item.prix }} €</td>
              <td class="py-4 text-right">{{ (item.prix * item.quantity).toFixed(2) }} €</td>
              <td class="py-4 text-right">
                <button 
                  @click="removeFromCart(item.id)"
                  class="text-red-500 hover:text-red-700"
                >
                  Supprimer
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="flex justify-between items-center">
        <button 
          @click="clearCart"
          class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md transition-colors"
        >
          Vider le panier
        </button>
        
        <div class="text-right">
          <div class="text-lg font-semibold mb-2">
            Total: {{ totalPrice.toFixed(2) }} €
          </div>
          <button class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md transition-colors">
            Commander
          </button>
        </div>
      </div>
    </div>
  </div>
</template>