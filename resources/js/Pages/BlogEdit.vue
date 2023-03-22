<template>
    <div>
      <h1>Edit Blog Post</h1>
      <form @submit.prevent="updateBlog">
        <label for="title">Title:</label>
        <input type="text" id="title" v-model="blog.title" required>
  
        <label for="body">Body:</label>
        <textarea id="body" v-model="blog.body" required></textarea>
  
        <button type="submit">Update</button>
      </form>
    </div>
  </template>
  
<script>
  import axios from 'axios';
  
  export default {
    name: 'BlogEdit',
    data() {
      return {
        blog: {},
      };
    },
    created() {
      axios.get(`/api/blogs/${this.$route.params.id}`)
        .then((response) => {
          this.blog = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    methods: {
      updateBlog() {
        axios.put(`/api/blogs/${this.$route.params.id}`, this.blog)
          .then(() => {
            this.$router.push({ name: 'blog.index' });
          })
          .catch((error) => {
            console.log(error);
          });
      },
    },
  };
</script>
  