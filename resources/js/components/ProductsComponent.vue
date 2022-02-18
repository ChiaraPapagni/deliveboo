<template>
  <!-- stampo il singolo prodotto del ristorante -->
  <div class="col hover01" @click="add_product()">
    <figure>
      <img
        src="http://127.0.0.1:8000/img-prova/panino1.png"
        alt=""
        class="img"
      />
    </figure>
    <h3>{{ product.name }}</h3>
    <p>{{ product.price }} $</p>
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
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
