import { ref, computed, watch } from 'vue';

// Create a reactive cart state that persists through page refreshes
const cartItems = ref([]);

// Load cart from localStorage on initialization
try {
  const savedCart = localStorage.getItem('cart');
  if (savedCart) {
    cartItems.value = JSON.parse(savedCart);
  }
} catch (e) {
  console.error('Error loading cart from localStorage:', e);
}

// Watch for changes to cart and save to localStorage
watch(cartItems, (newItems) => {
  localStorage.setItem('cart', JSON.stringify(newItems));
}, { deep: true });

export function useCart() {
  // Add an item to the cart
  const addToCart = (article) => {
    const existingItem = cartItems.value.find(item => item.id === article.id);
    
    if (existingItem) {
      // If item already exists, increment quantity
      existingItem.quantity += 1;
    } else {
      // Otherwise add new item with quantity 1
      cartItems.value.push({
        ...article,
        quantity: 1
      });
    }
  };

  // Remove an item from the cart
  const removeFromCart = (articleId) => {
    const index = cartItems.value.findIndex(item => item.id === articleId);
    if (index !== -1) {
      cartItems.value.splice(index, 1);
    }
  };

  // Update quantity of an item
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

  // Calculate total price
  const totalPrice = computed(() => {
    return cartItems.value.reduce((total, item) => {
      return total + (item.prix * item.quantity);
    }, 0);
  });

  // Calculate total items count
  const itemCount = computed(() => {
    return cartItems.value.reduce((count, item) => count + item.quantity, 0);
  });

  // Clear the cart
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