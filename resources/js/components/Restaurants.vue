<template>
  <div class="container mx-auto">
    <div class="categoryContainer py-5">
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
          <div class="category-card" style="width: 15rem">
            <img
              :src="'./img/categories_images/' + category.category_image"
              alt="Card
            image cap"
            />
            <div class="category-body">
              <input
                type="checkbox"
                class="categories"
                :id="category.id"
                :value="category.id"
                v-model="checkedCat"
                @change="getRestaurants()"
              />

              <label :for="category.id" class="category-name">{{
                category.name
              }}</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Categories -->

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
.category-card {
  position: relative;
  border-radius: 0.5rem;
  overflow: hidden;
  img {
    width: 100%;
    object-fit: cover;
    height: 7.5rem;
    aspect-ratio: 4/3;
  }
  .category-body {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    label {
      background-color: #fece2c;
      box-shadow: -5px 6px 0px 1px #3b3b3b;
      -webkit-box-shadow: -5px 6px 0px 1px #3b3b3b;
      border-radius: 0;
      padding: 0.2rem 0.8rem;
      color: #3b3b3b;
      font-size: 1.2rem;
      font-weight: 500;
      text-transform: uppercase;
      cursor: pointer;
    }

    input.categories:checked + label {
      color: #fece2c;
      background-color: #3b3b3b;
      box-shadow: -5px 6px 0px 1px #fece2c;
      -webkit-box-shadow: -5px 6px 0px 1px #fece2c;
    }
  }
}

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
