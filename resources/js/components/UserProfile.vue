<template>
  <form @submit.prevent="onSubmit">
    <div class="form-group">
      <label for="">Username</label>
      <input required class="form-control" type="text" v-model="user.name" />
    </div>

    <div class="form-group">
      <label for="">Email</label>
      <input required class="form-control" type="email" v-model="user.email" />
    </div>

    <div class="form-group">
      <label for="">Password</label>
      <input type="password" class="form-control" v-model="user.password" />
      <span class="form-hint">Leave empty to keep the old password</span>
    </div>

    <div class="form-group">
      <label for="">Confirm Password</label>
      <input
        type="password"
        v-model="user.password_confirmation"
        class="form-control"
        @paste="onPasswordPaste"
      />
    </div>

    <div class="form-group mt-4 text-right">
      <button class="btn btn-outline-primary" type="submit">
        Update Profile
      </button>
    </div>
  </form>
</template>

<script>
export default {
  props: ["profile"],

  data() {
    return {
      user: {
        name: JSON.parse(this.profile).name,
        email: JSON.parse(this.profile).email,
        password: "",
        password_confirmation: "",
      },
    };
  },

  methods: {
    // Disable Pasting Password during confirmation
    onPasswordPaste(e) {
      e.preventDefault();
    },

    onSubmit() {
      axios
        .post("/profile/2", this.user)
        .then((response) => {
          response.status === 204 &&
            flash("Profile has been Updated...", "alert-primary");
        })
        .catch((error) => {
          let errorMessage = '';
          
          if(error.response.data.errors){
            Object.values(error.response.data.errors).forEach((error, i) => errorMessage += ('=> ' + error));
          }
          
          flash(errorMessage || 'Cant update Profile', "alert-danger");
        });
    },
  },
};
</script>