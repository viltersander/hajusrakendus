<template>
    <nav class="bg-gray-800">
        <div class="max-w-screen-lg mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <Link
                    href="/weather"
                    class="block mt-4 sm:inline-block sm:mt-0 text-blue-200 hover:text-white mr-4"
                >
                    Weather
                </Link>
                <Link
                    href="/map"
                    class="block mt-4 sm:inline-block sm:mt-0 text-blue-200 hover:text-white mr-4"
                >
                    Map
                </Link>
                <Link
                    href="/blog"
                    class="block mt-4 sm:inline-block sm:mt-0 text-blue-200 hover:text-white mr-4"
                >
                    Blog
                </Link>
            </div>
            <div>
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-blue-500 hover:bg-white mt-4 sm:mt-0 ml-4"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-blue-500 hover:bg-white mt-4 sm:mt-0 ml-4"
                        >
                            Log in
                        </Link>
                        <Link
                            v-if="canRegister"
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
import { useRouter } from 'vue-router'
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3';

const router = useRouter()

// Check if user is logged in
const isLoggedIn = computed(() => {
return localStorage.getItem('user') !== null
})

function logout() {
localStorage.removeItem('user')
router.push('/')
}

</script>
  