<template>
  <div class="row">
    <div class="card" v-for="(product, i) in cart" :key="i">
      <h1>{{ product.name }}</h1>
      <div class="QtyBtn">
        <button @click="remove_qty(product)" id="lessQty">-</button>
        <span id="coutnerQty">{{ product.qty }}</span>
        <button @click="add_qty(product)" id="moreQty">+</button>
      </div>
    </div>
    <span class="p-5">{{ total }}</span>
  </div>
</template>

<script>
export default {
  props: {
    cart: {},
    total: Number,
  },

  mounted() {},

  methods: {
    remove_qty(product) {
      console.log(product);
      if (product.qty <= 1) {
        product.qty = 1;
      } else {
        product.qty--;
      }
    },

    add_qty(product) {
      console.log(product);
      product.qty++;
    },
  },
};
</script>
