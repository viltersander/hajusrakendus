<template>
    <nav class="bg-gray-800">
        <div class="max-w-screen-lg mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
            <router-link to="/" class="text-gray-300 hover:text-white mr-4">
                Home
            </router-link>
            <router-link to="/blogs" class="text-gray-300 hover:text-white mr-4">
                Blogs
            </router-link>
            </div>
            <div class="flex items-center">
            <router-link to="/new-blog" class="bg-purple-500 hover:bg-purple-600 px-4 py-2 rounded-md text-white mr-4">
                Create a new blog
            </router-link>
            <router-link v-if="isLoggedIn" to="/my-blog" class="text-gray-300 hover:text-white">
                My Blog
            </router-link>
            <button v-if="isLoggedIn" @click="logout" class="bg-purple-500 hover:bg-purple-600 px-4 py-2 rounded-md text-white ml-4">
                Logout
            </button>
            <router-link v-else to="/login" class="bg-purple-500 hover:bg-purple-600 px-4 py-2 rounded-md text-white ml-4">
                Login
            </router-link>
            </div>
        </div>
        </div>
    </nav>
</template>
  
<script setup>
import { useRouter } from 'vue-router'
import { computed } from 'vue'

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
  