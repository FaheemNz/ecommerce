<template>
  
</template>

<script>
export default {
  props: ["url"],
  data() {
    return {
      form: {
        rating: "",
        body: "",
      },
    };
  },

  methods: {
    addReview() {
      axios
        .post(this.url, this.form)
        .then(
          (response) => response.status === 201 && this.onReviewAddComplete()
        )
        .catch((error) => flash("Invalid rating given...", "alert-danger"));
    },

    updateUI() {
      flash(response.data.message, "alert-success");
      this.form.body = "";
      this.form.rating = "";
    },
  },
};
</script>