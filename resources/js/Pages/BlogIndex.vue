<template>
    <div>
      <h1>Blog Posts</h1>
      <ul>
        <li v-for="blog in blogs" :key="blog.id">
          <router-link :to="'/blog/' + blog.id">{{ blog.title }}</router-link>
          <button @click="editBlog(blog)">Edit</button>
          <button @click="deleteBlog(blog)">Delete</button>
        </li>
      </ul>
      <router-link to="/blog/create">Create New Blog Post</router-link>
    </div>
  </template>
  
<script>
  export default {
    data() {
      return {
        blogs: [],
      };
    },
    created() {
      this.fetchBlogs();
    },
    methods: {
      fetchBlogs() {
        axios.get('/api/blog').then((response) => {
          this.blogs = response.data;
        });
      },
      editBlog(blog) {
        this.$router.push({ name: 'blog.edit', params: { blog: blog.id } });
      },
      deleteBlog(blog) {
        if (confirm(`Are you sure you want to delete "${blog.title}"?`)) {
          axios.delete(`/api/blog/${blog.id}`).then(() => {
            this.fetchBlogs();
          });
        }
      },
    },
  };
</script>
  