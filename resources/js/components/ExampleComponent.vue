<template>
  <div v-if="loading">
    <!-- Category Container [cards]  -->
    <div class="categoryContainer py-5">
      <div class="container">
        <h2 class="text-capitalize pb-5 pt-3 fs-1 text-end">
          choose your favourite categories!
        </h2>

        <div
          class="
            row row-cols-2 row-cols-md-4 row-cols-xl-5
            gy-4
            w-100
            justify-content-center
          "
        >
          <div class="col" v-for="category in categories" :key="category.id">
            <!-- Card -->
            <div
              class="card"
              :id="'cat' + category.id"
              @click="filterCategories(category.id)"
            >
              <!--  Card Image  -->
              <div class="card-body w-100 text-center">
                <img width="90%" :src="category.category_image" alt="" />
              </div>

              <!-- Cards Info -->
              <div class="card-text w-100">
                <h3>{{ category.name }}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- SearchBar Per i Ristoranti  -->
    <div class="searchbarContainer py-5">
      <div class="container">
        <div class="mb-3">
          <h3 for="restaurant" class="form-label text-capitalize">
            ricerca i tuoi ristoranti preferiti!
          </h3>
          <input
            type="text"
            name="restaurant"
            id="restaurant"
            class="form-control"
            placeholder="Type restaurant's name"
            aria-describedby="helpId"
          />
          <small id="helpId" class="text-muted"
            >Scrivi il nome del ristorante dove vuoi ordinare</small
          >
        </div>
      </div>
    </div>

    <!-- Restaurant Container -->
    <div class="restaurantContainer py-5">
      <div class="container">
        <h2 class="text-capitalize pb-5 pt-3 fs-1 text-end">
          choose your favourite restaurant!
        </h2>

        <div
          class="
            row row-cols-2 row-cols-md-4 row-cols-xl-5
            gy-4
            w-100
            justify-content-center
          "
        >
          <!--  Ciclo per stampare le cards -->

          <div
            class="col"
            v-for="(restaurant, index) in FilterRestaurants"
            :key="index"
          >
            <!-- <router-link :to="'/restaurant/' + restaurant.slug"></router-link> -->

            <!--  Card  -->
            <div v-show="restaurant.visible" c  lass="card">
              <!--  Card Image  -->
              <div class="card-body w-100 text-center">
                <img width="90%" :src="restaurant.restaurant_image" alt="" />
              </div>

              <!--   Cards Info  -->
              <div class="card-text w-100">
                <h3>{{ restaurant.name }}</h3>
              </div>
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
      loading: false,
      categories: Array,
      restaurants: [],
      FilterRestaurants: [],
      SceltaCategory: [],
      counter: [],
    };
  },
  mounted() {
    axios.get("api/restaurants").then((response) => {
      this.categories = response.data[0];

      /* Ciclo nelle categorie. 
      Nella singola categoria accedo alla proprietà restaurants ove sono presenti tutti i ristoranti associati a tale categoria.
      Poi attraverso un altro ciclo prendo il singolo ristorante 
      controllo che non sia già presenti nell'array this.restaurants
      e lo pusho all'array dei ristoranti*/

      this.categories.forEach((restaurant) => {
        restaurant.restaurants.forEach((one_restaurant) => {
          this.restaurants.push(one_restaurant);
        });
      });

      this.restaurants.forEach((restaurant)=>{
        restaurant.visible = false
      })
      

      this.loading = true;
    });
    console.log("Component mounted.");
    console.log(this.restaurants);
  },

  /* filtro
  some
  pusho
*/

  methods: {
    filterCategories(id) {
      if (!this.counter.includes(id)) {
        this.counter.push(id);

        this.SceltaCategory = [],

        this.SceltaCategory = this.restaurants.filter(
          (element) => element.pivot.category_id === id
        );

        

        this.SceltaCategory.forEach(element =>
          element.visible = true
        )

        

         /* var ids = new Set(
          this.FilterRestaurants.map((Restaurant) => Restaurant.id)
        );

          this.FilterRestaurants = [
          ...this.FilterRestaurants,
          ...this.SceltaCategory.filter(
            (Restaurant) => !ids.has(Restaurant.id)
          ),
        ];  */   

          this.FilterRestaurants = this.FilterRestaurants.concat(
          this.SceltaCategory
        ); 

        this.FilterRestaurants.find(element => 
          element.restaurant.id ===
          )
        

        /*  this.FilterRestaurants = this.FilterRestaurants.filter((ar) =>
          this.SceltaCategory.find(
            (rm) =>
              rm.id === ar.id && ar.pivot.category_id === rm.pivot.category_id
          )
        );  */

        // contaneto Scelta e Filter = ho array con oggetti simili(restaurt_id uguale ma category differente)
        // se filto i ristoranti che non hanno la categoria che voglio?!

        //console.log(this.counter)
      } else {
        this.counter = this.counter.filter((element) => element != id);

        // rimuovi quelli con category_id = id
        // filter(category_id===id )
        // pop

        this.SceltaCategory = this.restaurants.filter(
          (element) => element.pivot.category_id === id
        );

        this.FilterRestaurants = this.FilterRestaurants.filter(
          (ar) =>
            !this.SceltaCategory.find(
              (rm) =>
                rm.id === ar.id && ar.pivot.category_id === rm.pivot.category_id
            )
        );

        //console.log(this.FilterRestaurants);

        //console.log(this.counter)
      }

      //console.log(this.FilterRestaurants);
    },
  },
};
</script>
