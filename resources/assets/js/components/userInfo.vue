<template>
  <div class="container">
    <h3>USer info</h3>
    <p></p>
    <button @click="getUser()">get user info!</button>
  </div>
</template>

<script>
export default {
  /*
    * The component's data.
    */
  data() {
      return {
          accessToken: null,

          user: {
              name: '',
              email: '',
          }
      };
  },
  methods: {
    getUser() {
        axios.get('/api/user')
                .then(response => {
                    console.log(response.data);
                });
    },
  }
}


</script>