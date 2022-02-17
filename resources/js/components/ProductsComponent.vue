<template>
  <div>
    <div class="col-lg-3 hover01" @click="add_product()">
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
  </div>
</template>

<script>
export default {
  props: {
    product: {},
  },

  mounted() {
    //console.log("Component mounted.");
    //console.log(this.product);
    //console.log(this.singleProduct);
  },

  methods: {
    add_product() {
      this.$emit("add-cart", this.product);
    },
  },
};
</script>
