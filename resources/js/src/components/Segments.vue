<template>
  <div class="container flex flex-col items-start justify-start w-full h-[60em]">
    <h3 class="text-xl mb-4">RFM-сегменты</h3>
    <div class="flex items-start justify-center">
      <div class="mt-4 grid grid-cols-3 gap-4">
        <Segment v-for="segment in reversedSegments" :segment="segment" />
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue'; 

import Segment from './Segment.vue';

export default {
  name: 'Segments',
  components: {
    Segment,
  },
  setup() {
    const segments = ref([]);

    const fetchData = async () => {
      try {
        const response = await fetch('http://localhost/api/get-data');
        const data = await response.json();
        segments.value = data.segments;
        console.log(data);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    onMounted(() => {
      fetchData();
    });

    const reversedSegments = ref([]);

    watch(() => segments.value, () => {
      reversedSegments.value = [...segments.value].reverse();
    });

    return {
      segments,
      reversedSegments,
    };
  },
};
</script>
