<template>
  <div class="container">
    <div class="categoryContainer py-5">
      <!-- <h2 class="pb-5 pt-3 fs-1 category-title">
        Scegli la categoria preferita
      </h2> -->
      <div class="container categorie pt-5" id="order_now">
        <div class="line"></div>
        <div class="titolo-ristorante">Seleziona le categorie</div>
        <div class="line"></div>
      </div>

      <div
        class="
          d-flex
          flex-wrap
          align-items-center
          justify-content-center
          seleziona-categorie
        "
      >
        <div
          class="m-2 category-input"
          v-for="(category, i) in categories"
          :key="i"
        >
          <div class="card" style="width: 18rem">
            <img
              class="card-img-top"
              :src="'./img/categories_images/' + category.category_image"
              alt="Card
            image cap"
            />
            <div class="card-body">
              <input
                type="checkbox"
                class="categories"
                :id="category.id"
                :value="category.id"
                v-model="checkedCat"
                @change="getRestaurants()"
              />

              <label
                :for="category.id"
                class="btn btn-sm border category-name"
                >{{ category.name }}</label
              >
            </div>
          </div>
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

    <div class="risotranti-disponibili pt-5" id="order_now">
      <div class="line"></div>
      <div class="titolo-ristorante">Scegli i Ristoranti disponibili</div>
      <div class="line"></div>
    </div>

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
          <a :href="'/restaurants/' + restaurant.slug" class="link">
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
                <h3 class="text">{{ restaurant.name }}</h3>
              </div>
            </div>
          </a>
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
  },
};
</script>

<style lang="scss" scoped>
/* .categoryContainer {
  display: flex;
  justify-content: space-between;
} */

.categorie {
  display: flex;
  justify-content: center;
  margin-bottom: 3rem;
}
.category-title {
  margin-top: 2rem;
}

.category-name {
  font-size: 20px;
  border-radius: 0.5rem;
}

.category-name:hover {
  color: black;
}

.seleziona-categorie {
  margin-top: 5rem;
}

input.categories {
  display: none;
}

input.categories:checked + label {
  background-color: brown;
  color: #fff;
}

.risotranti-disponibili {
  display: flex;
  justify-content: center;
  margin-bottom: 1rem;
}

.titolo-ristorante {
  align-items: center;
  font-size: 25px;
  font-weight: bold;
  margin-left: 10px;
  margin-right: 10px;
}

.col {
  width: 300px;
}

/* card */

.text {
  font-size: 20px;
  text-align: center;
  text-decoration: none;
  color: black;
}

.link {
  text-decoration: none;
}

.card {
  --card-gradient: rgba(0, 0, 0, 0.8);
  --card-blend-mode: overlay;
  // --card-blend-mode: multiply;

  background-color: brown;
  border-radius: 0.5rem;
  box-shadow: 0.05rem 0.1rem 0.2rem -0.03rem rgba(0, 0, 0, 0.45);
  padding-bottom: 1rem;
  background-image: linear-gradient(
    var(--card-gradient),
    white max(9.5rem, 27vh)
  );
  overflow: hidden;
  text-align: center;

  img {
    border-radius: 0.5rem 0.5rem 0 0;

    object-fit: cover;
    // height: max(10rem, 25vh);
    max-height: max(8rem, 20vh);
    aspect-ratio: 4/3;
  }
}
</style>
