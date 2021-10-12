require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('minigames-play', require('./components/MINIGAMES/Play.vue').default);

const app = new Vue({
  data() {
      return {}
  },

  watch: {},

  computed: {},

  methods: {
    init() {},
  },

  mounted() {
    let vue = this;
    vue.init();
  },

}).$mount('#app');