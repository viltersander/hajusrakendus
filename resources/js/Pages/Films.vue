<template>
  <Navbar />
  <div class="mt-16 max-w-screen-lg w-full mx-auto flex-wrap px-6 mb-10">
    <div class="flex justify-center gap-4">
        <Link href="/films" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition duration-300">Films</Link>
        <Link href="/dogs" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition duration-300">Dogs</Link>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-12 lg:grid-cols-3">
      <div v-for="film in films" :key="film.id" class="w-72 flex flex-col  shadow hover:shadow-lg mx-auto rounded">
        <img :src="film.image" :alt="film.title" class="h-64 object-resize w-full rounded-t">
        <div class="p-4">
          <h2 class="text-lg font-medium">{{ film.title }}</h2>
          <p class="text-gray-600 text-sm mt-2">{{ film.description }}</p>
          <div class="flex items-center mt-3">
            <span>Rating: {{ film.rating }}</span>
          </div>
          <div class="mt-4">
            <span class="text-gray-600 text-sm">{{ formatDate(film.release_date) }}</span>
          </div>
        </div>
      </div>
    </div>
</div>

</template>
<script setup>
import Navbar from '@/Components/Navbar.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  films: {
    films: Array,  
  },
});

const formatDate = (date) => {
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date).toLocaleDateString('en-US', options);
};

</script>