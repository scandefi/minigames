<template>
  <section class="example-component">
    <!-- <button class="button is-primary is-small" @click.prevent="login">LOGIN</button>
    <button class="button is-primary is-small" @click.prevent="authuser">AUTHUSER</button>
    <button class="button is-primary is-small" @click.prevent="logout">LOGOUT</button>
    <button class="button is-primary is-small" @click.prevent="complaints">COMPLAINTS</button>
    <button class="button is-primary is-small" @click.prevent="bot">DETECT BOT</button> -->
    <div class="webgl-content" style="width:100vw;height:100vh;"></div>
    <div id="unityContainer" style="width:100vw;height:100vh;"></div>
  </section>
</template>

<script>
  export default {
    props: {},

    data() {
      return {}
    },

    watch: {
      data: {
        immediate: true,
        deep: true,
        handler(val, oldVal) {
          //do something
        }
      },
    },

    computed: {},

    methods: {
      // login() {
      //   axios.post('/api/users/login-or-register', {wallet:'0xbE8fC9ff98CD894141F40c2f995E3C96d12aa1Ce'}).then(response => {
      //     console.info(response.data);
      //   });
      // },
      // authuser() {
      //   axios.post('/api/authuser').then(response => {
      //     console.info(response.data);
      //   });
      // },
      // logout() {
      //   axios.post('/api/users/logout').then(response => {
      //     console.info(response.data);
      //   });
      // },
      // complaints() {
      //   axios.get('https://scandefi.test/api/complaints').then(response => {
      //     console.info(response.data);
      //   });
      // },
      // bot() {
      //   axios.get('/api/bot').then(response => {
      //     console.info(response.data);
      //   });
      // },
    },

    mounted() {}
  }
</script>
