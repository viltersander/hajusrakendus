<template>
    <Navbar />
    <div class="flex-start p-6 items-center font-semibold gap-2 flex-col " v-if="data">
      <img :src="weatherIcon" alt="" />
      <p>{{ data.name }}</p>
      <p><span class="font-normal">Temperature: </span>{{Math.round(data.main.temp)}}℃</p>
      <p><span class="font-normal">Feels like: </span>{{Math.round(data.main.feels_like)}}℃</p>
      <p><span class="font-normal">Description: </span>{{data.weather[0].description}}</p>
    </div>
</template>
  
<script setup>
import { computed } from "@vue/runtime-core";
import Navbar from '../Components/Navbar.vue';

const props = defineProps({
  data: Object,
  default: null,
});

const weatherIcon = computed(
  () => `https://openweathermap.org/img/w/${props.data?.weather[0].icon}.png`
);
console.log(props.data)
</script>
  
