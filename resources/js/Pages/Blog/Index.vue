<template>
  <div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold my-4">Blogi postitused</h1>
    <button v-if="user && user.is_admin" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded mb-4" @click="createBlog()">Loo uus postitus</button>
    <hr class="mb-4">
    <div v-for="blog in blogs" :key="blog.id">
      <div class="bg-white shadow-md rounded px-8 p-4 pt-6 pb-8 mb-4 max-w-lg">
        <h4 class="font-bold text-xl mb-2">{{ blog.title }}</h4>
        <p class="text-gray-700 text-base">{{ blog.description }}</p>
        <button v-if="user && user.is_admin" class="bg-yellow-500 hover:bg-yellow-700 font-bold py-2 px-4 rounded mt-4 inline-block" @click="editBlog(blog.id)">Redigeeri</button>
        <button class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded mt-4 inline-block" @click="toggleComments(blog.id)">Näita kommentaare</button>
        <div :id="'comments' + blog.id" class="hidden mt-4">
          <h3 class="font-bold mb-2">Kommentaarid:</h3>
          <h3 class="font-bold mb-2 mt-4">Lisa kommentaar:</h3>
          <form @submit.prevent="addComment(blog.id)">
            <textarea v-model="newCommentText" class="w-full rounded-lg p-2" placeholder="Kommentaari sisu"></textarea>
            <br>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded mt-2">Saada</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
  name: 'Blog',
  props: {
    blogs: Array,
    user: Object,
  },
  
  setup(props) {
    const newCommentText = ref('');
    console.log('is_admin prop:', props.is_admin);
    console.log('user prop:', props.user);
    function toggleComments(blogId) {
      const commentsEl = document.getElementById(`comments${blogId}`);
      commentsEl.classList.toggle('hidden');
    }


return {
  newCommentText,
  toggleComments,
};

}
};
</script>