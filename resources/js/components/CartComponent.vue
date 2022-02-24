<template>
  <!-- Stampo il singolo prodotto del carello-->
  <div v-show="cart.length > 0" class="border">
    <div>
      <h3 class="carrello">Carrello</h3>
    </div>
    <div class="card" v-for="(product, i) in cart" :key="i">
      <div class="d-flex justify-content-between">
        <p class="product-name">{{ product.name }}</p>
        <p class="product-price">{{ product.price }} €</p>
      </div>

      <!-- funzione per selezionare la quantità -->
      <div class="QtyBtn">
        <div>
          <button
            @click="
              remove_qty(product, cart);
              refreshQty(product.qty);
            "
            id="lessQty"
            class="btn-minus"
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
            class="btn-plus"
          >
            +
          </button>
        </div>

        <i
          class="fas fa-trash-alt"
          style="color: red; font-size: 25px"
          @click="removeProduct(product, cart)"
        ></i>
      </div>
    </div>
    <div class="d-flex justify-content-between">
      <span class="subtotale">Subtotale: {{ total.toFixed(2) }} €</span>
      <a href="/checkout"
        ><button type="submit" class="button-checkout">
          Procedi all'ordine
        </button></a
      >
    </div>
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

<style lang="scss" scoped>
.carrello {
  color: white;
  text-align: end;
  font-size: 20px;
}
.card {
  margin-bottom: 2rem;
  padding: 10px;
}

.product-name {
  font-weight: bold;
  margin-bottom: 2rem;
}

.product-price {
  font-weight: bold;
}

.QtyBtn {
  display: flex;
  justify-content: space-between;
}

.border {
  border-radius: 0.25rem;
  padding: 10px;
  background-color: #fece2c;
  margin-top: 3rem;
}

.button-checkout {
  background-color: lightgreen;
  border: 2px solid lightgreen;
  border-radius: 0.25rem;
  align-items: center;
  width: 150px;
  font-size: 15px;
  color: white;
}

.fa-trash-alt:hover {
  cursor: pointer;
}

.btn-minus {
  border-radius: 0.25rem;
  border: 2px solid lightgrey;
  width: 25px;
}

.btn-plus {
  border-radius: 0.25rem;
  border: 2px solid lightgrey;
  width: 25px;
}

.subtotale {
  font-weight: bold;
  font-size: 13px;
  margin-top: 5px;
  color: white;
}
</style>