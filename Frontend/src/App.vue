
<template>
  
  <div><h1 class="font-bold text-2xl text-red-500">Hellow world we are coming</h1></div>
  
  <button @click="api1" class="border bg-amber-200">API 1</button><br>
  
  </template>
  
  
  <script>
  import axios from 'axios';
    export default {
      name:'App',
      methods:{
        api1(){
          axios.get("http://localhost/monsalonline/Pages/index").then((res)=>console.log(res))
        },
      }
    }
  
  
  </script>
  
  
  <style scoped>
  
  </style>
  