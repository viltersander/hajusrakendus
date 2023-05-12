<template>
    <div class="container mx-auto px-4">
      <h1 class="text-3xl font-bold mb-4">Loo uus postitus</h1>
      <form @submit.prevent="createBlog" class="max-w-lg">
        <div class="mb-4">
          <label for="title" class="block text-gray-700 font-bold mb-2">Pealkiri</label>
          <input v-model="title" type="text" name="title" class="form-textarea rounded-md shadow-sm w-full" placeholder="Sisesta pealkiri">
        </div>
        <div class="mb-4">
          <label for="description" class="block text-gray-700 font-bold mb-2">Kirjeldus</label>
          <textarea v-model="description" name="description" class="form-textarea rounded-md shadow-sm w-full" placeholder="Sisesta kirjeldus"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Loo postitus</button>
      </form>
    </div>
</template>
  
<script>
import axios from 'axios';

export default {
data() {
    return {
    title: '',
    description: ''
    };
},
methods: {
    createBlog() {
    axios.post('/blog', {
        title: this.title,
        description: this.description
    }).then(() => {
        // Redirect to blog index page after successful creation
        this.$router.push('/blog');
    }).catch((error) => {
        console.log(error);
    });
    }
}
};
</script>
  