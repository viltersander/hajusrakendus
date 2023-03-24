<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '../Components/Navbar.vue';
import Weather from './Weather.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

</script>

<template>
    <Head title="Welcome" />
    <Navbar />
</template>