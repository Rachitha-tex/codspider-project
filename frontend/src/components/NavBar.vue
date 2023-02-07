<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <div class="container-fluid">
    <router-link  class="navbar-brand" :to="{name:'HomePage'}">Home</router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <router-link class="nav-link fw-bold" :to="{name:'CategoryView'}">Category</router-link>
 
        </li>
        <li class="nav-item">
            <router-link class="nav-link" :to="{name:'ProductView'}">Product</router-link>
 
        </li>
      </ul>
    </div>
  </div>
</nav>
    </div>
</template>

<script>
    export default {
    name:'Navbar'        
    }
</script>

<style scoped>

</style>