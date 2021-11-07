<template>
  <div id="app">
    <NavBar />
    <div v-if="User">
      <p>Hi, {{ User.name }}</p>
    </div>
    <router-view />
  </div>
</template>

<script>
// @ is an alias to /src
import NavBar from "./components/NavBar.vue";
import { mapGetters } from "vuex";

export default {
  components: {
    NavBar,
  },
  computed: {
    ...mapGetters({ User: "StateUser" }),
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
#app .container,
#app .container-fluid {
  text-align: left;
}
</style>
