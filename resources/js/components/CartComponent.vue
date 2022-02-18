<template>
  <!-- Stampo il singolo prodotto del carello-->
  <div v-show="cart.length > 0">
    <span class="p-5">{{ total.toFixed(2) }}</span>
    <div class="card" v-for="(product, i) in cart" :key="i">
      <h1>{{ product.name }}</h1>

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
  </div>
</template>

<script>
export default {
  props: {
    cart: [],
    restaurant: Number,
    total: Number,
  },

  mounted() {
    if (localStorage.getItem("cart")) {
      try {
        if (
          JSON.parse(localStorage.getItem("cart"))[0].restaurant_id ==
          this.restaurant
        ) {
          console.log("cart overwritten");
          this.cart = JSON.parse(localStorage.cart);
        }
      } catch (e) {
        console.log("CATCH E");
        localStorage.removeItem("cart");
      }
    }
  },

  methods: {
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
        //IF local cart exist
        // if (localStorage.getItem("cart")) {
        //   //   // local cart first product == this page restaurant ID
        //   if (
        //     JSON.parse(localStorage.getItem("cart"))[0].restaurant_id ==
        //     this.restaurant
        //   ) {
        //     console.log("SAME LOCAL CART ON PRODUCT ADD (I HOPE)");
        //     // localStorage.cart = JSON.stringify(product);
        //   } else {
        //     console.log("NOT LOCAL CART");
        //     // localStorage.clear();
        //   }
        // } else {
        //   console.log("NO");
        // }
        console.log("assign");
        localStorage.cart = JSON.stringify(product);

        /*
ON CLICK
-if a product is added to cart while the restaurant id is different from product ones local storage is erased and cart is updated

*/
      },
      deep: true,
    },
  },
};
</script>
