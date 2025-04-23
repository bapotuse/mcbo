import { ref, computed } from 'vue';

const cartItems = ref([]);

try {
  const savedCart = localStorage.getItem('cart');
  if (savedCart) {
    cartItems.value = JSON.parse(savedCart);
  }
} catch (e) {
  console.error('Error loading cart from localStorage:', e);
}

export function useCart() {
  const addToCart = (article) => {
    const existingItem = cartItems.value.find(item => item.id === article.id);
    
    if (existingItem) {
      existingItem.quantity += 1;
    } else {
      cartItems.value.push({
        ...article,
        quantity: 1
      });
    }
  };

  const removeFromCart = (articleId) => {
    const index = cartItems.value.findIndex(item => item.id === articleId);
    if (index !== -1) {
      cartItems.value.splice(index, 1);
    }
  };

  const updateQuantity = (articleId, quantity) => {
    const item = cartItems.value.find(item => item.id === articleId);
    if (item) {
      if (quantity <= 0) {
        removeFromCart(articleId);
      } else {
        item.quantity = quantity;
      }
    }
  };

  const totalPrice = computed(() => {
    return cartItems.value.reduce((total, item) => {
      return total + (item.prix * item.quantity);
    }, 0);
  });

  const itemCount = computed(() => {
    return cartItems.value.reduce((count, item) => count + item.quantity, 0);
  });

  const clearCart = () => {
    cartItems.value = [];
  };

  return {
    cartItems,
    addToCart,
    removeFromCart,
    updateQuantity,
    totalPrice,
    itemCount,
    clearCart
  };
}