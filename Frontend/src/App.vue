

<template>
  <div>
    <img src="./assets/img/background.jpg" alt="" class="absolute -z-10 w-full h-full">
    <router-view />
  </div>
</template>
  
<script>
  export default {
    name:'App',
    data() {
      return {
        title : 'hellow it me'
      }
    },
  }
</script>


<style>

</style>
  