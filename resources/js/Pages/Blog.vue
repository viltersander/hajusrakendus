<template>
  <div>
    <nav class="flex items-center justify-between flex-wrap bg-gray-900 p-6">
    <!-- Logo and site name -->
    <div class="flex items-center flex-shrink-0 text-white mr-6">
      <span class="font-semibold text-xl tracking-tight">My Blog</span>
    </div>

    <!-- Links -->
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
      <div class="text-sm lg:flex-grow">
        <router-link to="/blog" class="block mt-4 lg:inline-block lg:mt-0 text-gray-300 hover:text-white mr-4 cursor-pointer">
          Blog
        </router-link>
        <router-link to='/create' class="block mt-4 lg:inline-block lg:mt-0 text-gray-300 hover:text-white mr-4 cursor-pointer">
          Create Blog
        </router-link>
      </div>
      <div>
        <router-link to="/login" class="block mt-4 lg:inline-block lg:mt-0 text-gray-300 hover:text-white mr-4 cursor-pointer">
          Login
        </router-link>
        <router-link to="/admin" class="block mt-4 lg:inline-block lg:mt-0 text-gray-300 hover:text-white cursor-pointer">
          Admin
        </router-link>
      </div>
    </div>
  </nav>

    <div class="max-w-screen-lg w-full mx-auto mt-12">
      <h1 class="text-2xl text-gray-700 pb-6">Blog</h1>

      <!-- List of posts -->
      <div v-if="posts.length">
        <ul class="space-y-4">
          <li v-for="post in posts" :key="post.id">
            <h2 class="text-lg font-medium">{{ post.title }}</h2>
            <p>{{ post.description }}</p>

            <ul class="space-y-2">
              <li v-for="comment in post.comments" :key="comment.id">
                {{ comment.body }}
              </li>
            </ul>

            <form @submit.prevent="addComment(post)">
              <div class="mt-4">
                <label class="block font-medium">Add Comment:</label>
                <textarea class="w-full border-gray-300 rounded-md shadow-sm" rows="5" v-model="newComment[post.id]" required></textarea>
              </div>
              <div class="mt-4">
                <button class="px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600" type="submit">Add Comment</button>
              </div>
            </form>
          </li>
        </ul>
      </div>

      <!-- No posts message -->
      <div v-else>
        <p>No posts yet.</p>
      </div>

      <!-- Create post form -->
      <form @submit.prevent="createPost">
        <h2 class="text-lg font-medium pt-12 pb-2">Create a new post</h2>
        <div>
          <label class="block font-medium">Title:</label>
          <input class="w-full border-gray-300 rounded-md shadow-sm" v-model="newPost.title" required>
        </div>
        <div class="mt-4">
          <label class="block font-medium">Description:</label>
          <textarea class="w-full border-gray-300 rounded-md shadow-sm" rows="5" v-model="newPost.description" required></textarea>
        </div>
        <div class="mt-4">
          <button class="px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600" type="submit">Create</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
  import { reactive } from 'vue';
  
  const posts = reactive([])
  const newComment = reactive({})

  const newPost = reactive({ title: '', description: '' })

  function createPost() {
    // Add new post to the list
    posts.push(newPost)

    // Clear form inputs
    newPost.title = ''
    newPost.description = ''
  }
  
  async function addComment(post) {
  const response = await axios.post('/comments', {
    body: newComment[post.id],
    blog_id: post.id,
  })

  post.comments.push(response.data)

  newComment[post.id] = ''
  }


  const props = defineProps({
    posts: {
      type: Array,
      default: null,
    },
  });
  </script>

  