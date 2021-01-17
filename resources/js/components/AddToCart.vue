<template>
  <button v-if="text" class="btn btn-primary" @click.prevent="addItemToCart">
    {{ text }}
  </button>
  <button v-else @click.prevent="addItemToCart">
    <i class="fa fa-shopping-cart"></i>
  </button>
</template>

<script>
export default {
  props: ["id", "text"],

  methods: {
    addItemToCart() {
      axios.post(`/cart/${this.id}`).then((response) => {
        if (response.status === 201) {
          let navCount = document.getElementById("cart-nav-items-count");
          navCount.innerHTML = response.data.newCount;
          flash(response.data.message, "alert-success");          
          return;
        }
        flash(response.data.message, "alert-warning");
      });
    },
  },
};
</script>