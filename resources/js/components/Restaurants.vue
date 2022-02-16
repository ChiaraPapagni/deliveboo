<template>
  <div class="container">
    <div class="categoryContainer py-5">
      <h2 class="text-capitalize pb-5 pt-3 fs-1 text-end">
        Scegli la categoria preferita
      </h2>

      <div class="d-flex flex-wrap align-items-center justify-content-center">
        <div class="m-2" v-for="(category, i) in categories" :key="i">
          <input
            type="checkbox"
            class="categories"
            :id="category.id"
            :value="category.id"
            v-model="checkedCat"
            @change="getRestaurants()"
          />
          <label :for="category.id" class="btn btn-sm border">{{
            category.name
          }}</label>
        </div>
      </div>
    </div>
    <!-- Categories -->

    <!-- {{-- SearchBar Per i Ristoranti --}}
    <div class="searchbarContainer py-5">
        <div class="container">

            <div class="mb-3">
                <h3 for="restaurant" class="form-label text-capitalize">ricerca i tuoi ristoranti preferiti!</h3>
                <input type="text" name="restaurant" id="restaurant" class="form-control"
                    placeholder="Type restaurant's name" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Scrivi il nome del ristorante dove vuoi ordinare</small>
            </div>
        </div>
    </div> -->

    <div class="restaurantContainer py-5">
      <div
        class="
          row row-cols-2 row-cols-md-4 row-cols-xl-5
          gy-4
          w-100
          justify-content-center
        "
      >
        <div class="col" v-for="restaurant in restaurants" :key="restaurant.id">
          <div class="card">
            <div class="card-body w-100 text-center">
              <img
                width="90%"
                :src="
                  restaurant.restaurant_image
                    ? '/storage/' + restaurant.restaurant_image
                    : 'https://demofree.sirv.com/nope-not-here.jpg'
                "
                :alt="restaurant.name"
              />
            </div>
            <div class="card-text w-100">
              <h3>{{ restaurant.name }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      restaurants: [],
      categories: [],
      checkedCat: [],
      loading: true,
      meta: null,
      links: null,
    };
  },
  methods: {
    getCategories() {
      axios
        .get("/api/categories")
        .then((response) => {
          this.categories = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getRestaurants() {
      if (this.checkedCat.length === 0) {
        axios
          .get("/api/restaurants")
          .then((response) => {
            this.restaurants = response.data.data;
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        axios
          .get("/api/restaurants/filter/", {
            params: {
              category: this.checkedCat,
            },
          })
          .then((response) => {
            this.restaurants = response.data.data;
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
  mounted() {
    this.getCategories();
    this.getRestaurants();
    console.log("Component mounted.");
  },
};
</script>

<style lang="scss" scoped>
input.categories {
  display: none;
}

input.categories:checked + label {
  background-color: brown;
  color: #fff;
}
</style>
