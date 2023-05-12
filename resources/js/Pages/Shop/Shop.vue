<script setup>
import Layout from '@/Layouts/Layout.vue'
import Navbar from '@/Components/Navbar.vue';

import ProductCard from '@/Components/ProductCard.vue';
const props = defineProps({
    products: {
        type: Object,
        default:null,
    }
})  
console.log(props.products);
</script>

<template>
    <Navbar />
    <Layout>
        <div class="mt-16 max-w-screen-lg w-full mx-auto px-6">
            <h1 class="tracking-wider text-2xl">E-pood</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-12 lg:grid-cols-3">   
                <ProductCard v-for="product in products.data" :key="product" :product="product"/>
            </div>
        </div>
    </Layout>
</template>