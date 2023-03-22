<template>
    <div>
      <h1>Create New Blog Post</h1>
      <form @submit.prevent="submitForm">
        <div>
          <label for="title">Title:</label>
          <input type="text" id="title" v-model="form.title" required>
        </div>
        <div>
          <label for="content">Content:</label>
          <textarea id="content" v-model="form.content" required></textarea>
        </div>
        <button type="submit">Create</button>
      </form>
    </div>
  </template>
  
<script>
  export default {
    data() {
      return {
        form: {
          title: '',
          content: '',
        },
      };
    },
    methods: {
      submitForm() {
        axios.post('/api/blog', this.form).then(() => {
          this.$router.push({ name: 'blog.index' });
        });
      },
    },
  };
</script>
  