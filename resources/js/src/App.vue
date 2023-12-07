<template>
    <h1>
      {{ msg }}
      <RouterLink :to="{ name: 'test1' }">test1</RouterLink>
      <RouterLink :to="{ name: 'test2' }">test2</RouterLink>
    </h1>
    <p>
      <RouterView></RouterView>
    </p>
  </template>
  
  <script>
  import { ref } from 'vue';
  import { RouterLink, RouterView } from 'vue-router';
  
  export default {
    name: 'App',
    setup() {
      const msg = ref('Welcome to Your Vue.js App');
  
      return {
        msg,
      };
    },
  };
</script>