<template>
    <div class="relative bg-white shadow-lg rounded-md w-full md:w-[420px] h-[200px] mb-4 md:mb-0 md:mr-4">
      <div class="p-4">
  
        <div class="flex flex-col md:flex-row justify-between">
          <div class="mb-2 md:mb-0 md:mr-2">
            <h4 class="mb-6 text-gray-800 text-lg">{{ segment.key }}</h4>
          </div>
  
          <div
            class="w-full md:w-1/3 h-3/4 rounded-full text-white flex items-center mt-4 md:mt-0"
            :class="{
              'bg-gray-500': segment.key === 'Spiachie',
              'bg-yellow-500': segment.key === 'Somnevaychiesya',
              'bg-red-500': segment.key === 'Treb vnimaniya',
              'bg-blue-500': segment.key === 'Champions',
              'bg-purple-500': segment.key === 'Novichki',
              'bg-green-500': segment.key === 'Loyal',
            }"
          >
            <p class="text-lg mx-auto">Total: {{ segment.percentage_of_total }}%</p>
          </div>
        </div>
  
        <div class="flex flex-col md:flex-row">
          <div class="text-sm text-gray-600 w-full md:w-1/2">
            <div class="bg-gray-200 rounded-full px-4 py-2 mb-1">
              <p class="text-left">Clients: <span class="text-gray-900 font-bold">{{ segment.doc_count }}</span></p>
            </div>
            <div class="bg-gray-200 rounded-full px-4 py-2 mb-1">
              <p class="text-left">Orders: <span class="text-gray-900 font-bold">{{ segment.orders.value }}</span></p>
            </div>
            <div class="bg-gray-200 rounded-full px-4 py-2 mb-1">
              <p class="text-left">Avg Check: <span class="text-gray-900 font-bold">{{ segment.average_check }}</span></p>
            </div>
          </div>
        </div>
  
      </div>
    </div>
</template>
  
  <script>
  export default {
    props: {
      segment: {
        type: Object,
        required: true,
      },
    },
  };
  </script>
  