<template>
  <section class="minigames-play-component">
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

    methods: {},

    mounted() {}
  }
</script>
