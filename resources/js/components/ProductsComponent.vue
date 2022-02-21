<template>
  <!-- stampo il singolo prodotto del ristorante -->
  <div class="col hover01" @click="add_product()">
    <figure>
      <img
        v-if="!product.product_image"
        src="http://127.0.0.1:8000/img-prova/panino1.png"
        :alt="product.name"
        class="img"
      />
      <img
        v-else
        :src="'/storage/' + product.product_image"
        :alt="product.name"
        class="img"
      />
    </figure>
    <h3>{{ product.name }}</h3>
    <p>{{ product.price }} €</p>
    <p>{{ product.ingredients }}</p>
  </div>
</template>

<script>
export default {
  props: {
    product: {},
  },

  methods: {
    /* passo il prodotto al carello */
    add_product() {
      this.$emit("add-cart", this.product);
    },
  },
};
</script>
