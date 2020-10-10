<template>
  <button @click.prevent="addItemToCart">
    <i class="fa fa-shopping-cart"></i>
  </button>
</template>

<script>
export default {
  props: ["id"],

  methods: {
    addItemToCart() {
      axios.post(`/cart/${this.id}`).then((response) => {
        if (response.status === 201) {
          console.log("exists")
          flash(response.data.message, "alert-success");
          document.getElementById("cart-nav-items-count").innerHTML =
            response.data.newCount;
          return;
        }
        flash(response.data.message, "alert-warning");
      });
    },
  },
};
</script>