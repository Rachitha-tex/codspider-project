<template>
  <div>
    <NavbarView/>
    <router-view></router-view>

  </div>
</template>

<script>

//import HomePage from './views/HomePage.vue';
import NavbarView from './components/NavBar.vue';
  export default {
    name:'App',
    components:{
     // HomePage,
      NavbarView
    }
  }
</script>

<style scoped>

</style>