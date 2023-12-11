<template>
  <div>
    <div class="h-screen flex mt-24 justify-center">
      <div class="container mx-auto text-center">
        <button v-if="showButton" @click="navigateToSegments" class="bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg">
          Get Segments
        </button>
        <router-view v-else class="mt-4"></router-view>
      </div>
    </div>
  </div>
</template>

<script>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';

  export default {
    name: 'App',
    setup() {
      const router = useRouter();
      const showButton = ref(true);

      const navigateToSegments = () => {
        router.push('/segments');
        showButton.value = false;
      };

      return {
        navigateToSegments,
        showButton,
      };
    },
  };
</script>
