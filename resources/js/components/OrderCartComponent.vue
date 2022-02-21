<template>
  <div class="card">
    <div class="card-header">Carrello</div>
    <div id="cart">
      <!-- One Product -->
      <div
        class="card"
        v-show="cart.length > 0"
        v-for="product in cart"
        :key="product.id"
      >
        <img class="card-image" :src="product.image" alt="" />
        <h3>{{ product.name }}</h3>
        <span> Singola unita: {{ product.price }} $ </span>
        <!-- funzione per selezionare la quantità -->

        <div class="QtyBtn">
          <div @click="remove_qty(product)" id="lessQty">-</div>
          <span id="coutnerQty">{{ product.qty }}</span>
          <div @click="add_qty(product)" id="moreQty">+</div>
        </div>
      </div>

      <!-- Pass array cart to $request -->
      <div class="card-footer">
        <h6>TOTALE:</h6>
        <span v-if="total > 0" class="p-5">{{ total.toFixed(2) }}</span>
      </div>
      <input
        type="hidden"
        id="cart-data"
        name="cart"
        :value="JSON.stringify(cart)"
      />

      <input type="hidden" id="amount-data" name="amount" :value="total" />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cart: [],
      total: Number,
    };
  },

  methods: {
    totalCart() {
      this.total = 0;
      for (let i = 0; i < this.cart.length; i++) {
        this.total += this.cart[i].price * this.cart[i].qty;
      }
      return this.total;
    },

    add_qty(product) {
      product.qty++;
      if (product.qty > 100) {
        product.qty = 100;
      }
      this.totalCart();
    },

    remove_qty(product) {
      product.qty--;
      if (product.qty < 0) {
        product.qty = 0;
      }
      this.totalCart();
    },

    getCart() {
      /* Cart */
      if (localStorage.getItem("cart")) {
        if (JSON.parse(localStorage.getItem("cart")).length > 0) {
          this.cart = JSON.parse(localStorage.cart);
          console.log(this.cart);
        }
      }
    },
  },

  mounted() {
    this.getCart();
    this.totalCart();
  },
};
</script>
