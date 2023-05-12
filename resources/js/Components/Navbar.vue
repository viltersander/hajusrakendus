<template>
    <nav class="bg-gray-800">
        <div class="px-6">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center ">
                    <Link
                        href="/"
                        class="block sm:inline-block sm:mt-0 text-blue-200 hover:text-white mr-4"
                    >
                        Blog
                    </Link>
                    <Link
                        href="/weather"
                        class="block sm:inline-block sm:mt-0 text-blue-200 hover:text-white mr-4"
                    >
                        Weather
                    </Link>
                    <Link
                        href="/map"
                        class="block  sm:inline-block sm:mt-0 text-blue-200 hover:text-white mr-4"
                    >
                        Map
                    </Link>
                    <Link
                        href="/shop"
                        class="block  sm:inline-block sm:mt-0 text-blue-200 hover:text-white mr-4"
                    >
                        Shop
                    </Link>
                    <Link
                        href="/films"
                        class="block  sm:inline-block sm:mt-0 text-blue-200 hover:text-white mr-4"
                    >
                        Api
                    </Link>
                    <Link
                        href="/shopping-cart"
                        class="block  sm:inline-block sm:mt-0 text-blue-200 hover:text-white mr-4"
                    >
                    Cart
                    </Link>
                </div>
                <div>
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-blue-500 hover:bg-white sm:mt-0 ml-4"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-blue-500 hover:bg-white sm:mt-0 ml-4"
                        >
                            Log in
                        </Link>
                        <Link
                            :href="route('register')"
                            class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-blue-500 hover:bg-white mt-4 sm:mt-0 ml-4"
                        >
                            Register
                        </Link>
                    </template>
                </div> 
            </div>
        </div>
    </nav>
</template>
  
<script setup>
import { Head, Link } from '@inertiajs/vue3';


defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>