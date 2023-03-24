<template>
    <Navbar />
</template>

<script setup>

import Navbar from '../Components/Navbar.vue';

  const props = defineProps({
    posts: {
      type: Array,
      default: null,
    },
  });
</script>

  