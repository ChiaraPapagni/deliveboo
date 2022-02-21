<template>
  <!-- Stampo il singolo prodotto del carello-->
  <div v-show="cart.length > 0">
    <div class="card" v-for="(product, i) in cart" :key="i">
      <p>{{ product.name }}</p>

      <button type="button" @click="removeProduct(product, cart)">
        ELIMINA
      </button>
      <!-- funzione per selezionare la quantità -->
      <div class="QtyBtn">
        <button
          @click="
            remove_qty(product, cart);
            refreshQty(product.qty);
          "
          id="lessQty"
        >
          -
        </button>
        <span id="coutnerQty">{{ product.qty }}</span>
        <button
          @click="
            add_qty(product);
            refreshQty(product.qty);
          "
          id="moreQty"
        >
          +
        </button>
      </div>
    </div>
    <a href="/checkout"><button type="submit">PROCEDI AL CHECKOUT</button></a>
  </div>
</template>

<script>
export default {
  data() {
    return {
      success: false,
      error: false,
    };
  },
  props: {
    cart: [],
    total: Number,
  },

  methods: {
    onSuccess(message) {
      this.success = true;
    },

    onFailure(message) {
      this.error = true;
    },

    removeProduct(product, cart) {
      var index = cart.findIndex(function (element) {
        return element.id === product.id;
      });
      if (index !== -1) cart.splice(index, 1);
    },

    /* less qty product */
    remove_qty(product, cart) {
      product.qty--;
      if (product.qty <= 0) {
        this.removeProduct(product, cart);
      }
    },

    /* more qty product */
    add_qty(product) {
      product.qty++;
    },

    refreshQty(qty) {
      this.$emit("refresh-qty", qty);
    },
  },
  watch: {
    cart: {
      handler(product) {
        localStorage.cart = JSON.stringify(product);
      },
      deep: true,
    },
  },
};
</script>
