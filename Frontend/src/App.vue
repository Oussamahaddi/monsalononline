
<template>
  <div class="bg-[url]">
    <theHeader :title="title" />
    
    <button @click="api1" class="border bg-amber-200">API 1</button><br>
    <div id="test">{{ test }}</div>
  </div>
  
  </template>
  
  
  <script>
  import theHeader from './components/layouts/theHeader.vue'
  // import axios from 'axios';
    export default {
      name:'App',
      data() {
        return {
          title : 'hellow it me'
        }
      },
      components: {
        theHeader,
      },
      methods:{
        // api1(){
        //   axios.get("http://localhost/monsalonline/Pages/index").then((res)=> {
        //     this.test = res;
        //   })
        // },
      }
    }
  
  
  </script>
  
  
  <style>
  
  </style>
  