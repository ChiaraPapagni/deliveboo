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
        /*
We can access local storage data before passing them, now. (CHECK)

We need to make a check with restaurant ID/ product when:

ON REFRESH
-on refresh, if the restaurant isn't the same as the products rest. id, the cart wil not be updated
 AND the local storage is not erased

ON REFRESH
-if the current restaurant is the same as the product rest. id, the cart is updated with local storage.

ON CLICK
-if a product is added to cart while the restaurant id is different from product ones local storage is erased and cart is updated

ON SCORDATO
If cart has the same rest. id, 





        */
        // console.log(JSON.parse(localStorage.getItem("cart"))[0].restaurant_id);
        //VAFFANCULO ALLA IF
        if (
          JSON.parse(localStorage.getItem("cart"))[0].restaurant_id ==
          this.restaurant
        ) {
          this.cart = JSON.parse(localStorage.cart);
        }
      } catch (e) {
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
        if (localStorage.getItem("cart")) {
          console.log("YES");

          //   // local cart first product == this page restaurant ID
          //   if (
          //     JSON.parse(localStorage.getItem("cart"))[0].restaurant_id ==
          //     this.restaurant
          //   ) {
          //     console.log("SAME LOCAL CART ON PRODUCT ADD (I HOPE)");
          //     localStorage.cart = JSON.stringify(product);
          //   } else {
          //     console.log("NOT LOCAL CART");
          //     localStorage.clear();
          //   }
        } else {
          console.log("NO");
        }
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
