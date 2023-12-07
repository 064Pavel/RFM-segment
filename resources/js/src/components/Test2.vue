<template>
    <h1>
      {{ msg }}
    </h1>
  </template>
  
<script>
console.log("test 1");
  import { ref } from 'vue';
  
  export default {
    name: 'Test2',
    setup() {
      const msg = ref('Welcome to Your Vue.js Test2');
  
      return {
        msg,
      };
    },
  };
</script>