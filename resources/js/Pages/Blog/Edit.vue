<template>
    <div class="container mx-auto p-6">
      <h1 class="text-2xl font-bold mb-6">Redigeeri postitust</h1>
      <form @submit.prevent="updateBlog" class="max-w-lg">
        <div class="mb-4">
          <label for="title" class="block font-medium mb-2">Pealkiri</label>
          <input v-model="title" type="text" name="title" class="form-input rounded-md shadow-sm w-full">
        </div>
        <div class="mb-6">
          <label for="description" class="block font-medium mb-2">Kirjeldus</label>
          <textarea v-model="description" name="description" class="form-textarea rounded-md shadow-sm w-full"></textarea>
        </div>
        <div class="flex justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Uuenda postitus
          </button>
        </div>
      </form>
      <form @submit.prevent="deleteBlog" class="max-w-lg">
        <div class="mt-6">
          <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Kustuta postitus</button>
        </div>
      </form>
    </div>
</template>
  
<script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        title: '',
        description: '',
      };
    },
    mounted() {
      axios.get(`/blog/${this.$route.params.id}`).then(response => {
        this.title = response.data.title;
        this.description = response.data.description;
      }).catch(error => {
        console.log(error);
      });
    },
    methods: {
      updateBlog() {
        axios.put(`/blog/${this.$route.params.id}`, {
          title: this.title,
          description: this.description,
        }).then(response => {
          console.log(response.data);
          this.$router.push(`/blog/${this.$route.params.id}`);
        }).catch(error => {
          console.log(error);
        });
      },
      deleteBlog() {
        axios.delete(`/blog/${this.$route.params.id}`).then(response => {
          console.log(response.data);
          this.$router.push(`/blog`);
        }).catch(error => {
          console.log(error);
        });
      },
    },
  };
</script>
  