<template>
    <div v-for="blog in blogs" :key="blog.id">
    <div class="container mx-auto p-6">
      <div class="bg-white shadow-md rounded px-8 p-4 pt-6 pb-8 mb-4 max-w-lg">
        <h1 class="font-bold text-xl mb-2">{{ blog.title }}</h1>
        <p class="text-gray-700 text-base">{{ blog.description }}</p>
        <hr class="my-4">
        <h3 class="font-bold mb-2">Kommentaarid:</h3>
        <ul>
          <li v-for="comment in blog.comments" :key="comment.id" class="border rounded p-6 mb-2" style="word-wrap: break-word;">
            {{ comment.text }}
            <span v-if="comment.user" class="text-sm text-gray-500 float-right">{{ comment.user.name }}, {{ comment.created_at }}</span>
            <span v-else class="text-sm text-gray-500 float-right">Anonymous, {{ comment.created_at }}</span>
            <div v-if="loggedInUserId === comment.user_id || userIsAdmin">
              <form @submit.prevent="deleteComment(comment.id)">
                <button type="submit" class="text-red-600">Kustuta</button>
              </form>
            </div>
          </li>
        </ul>
        <h3 class="font-bold mb-2 mt-4">Lisa kommentaar:</h3>
        <form @submit.prevent="addComment">
          <textarea v-model="newCommentText" name="text" class="w-full rounded-lg p-2" placeholder="Kommentaari sisu"></textarea>
          <br>
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded mt-2">Saada</button>
        </form>
      </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      blogs: [],
      loggedInUserId: null,
      userIsAdmin: false,
      newCommentText: '',
    };
  },
  mounted() {
    this.fetchBlogs();
    this.fetchLoggedInUser();
  },
  methods: {
    fetchBlogs() {
      axios.get('/blog').then((response) => {
        this.blogs = response.data;
      }).catch((error) => {
        console.log(error);
      });
    },
    fetchLoggedInUser() {
      axios.get('/auth/user').then((response) => {
        if (response.data) {
          this.loggedInUserId = response.data.id;
          this.userIsAdmin = response.data.is_admin;
        }
      }).catch((error) => {
        console.log(error);
      });
    },
    toggleComments(blogId) {
      const commentsDiv = document.getElementById('comments' + blogId);
      commentsDiv.classList.toggle('hidden');
    },
    addComment(blogId) {
      axios.post('/blog/' + blogId + '/comments', {
        text: this.newCommentText
      }).then((response) => {
        const newComment = response.data;
        const blogIndex = this.blogs.findIndex((blog) => blog.id === blogId);
        this.blogs[blogIndex].comments.push(newComment);
        this.newCommentText = '';
      }).catch((error) => {
        console.log(error);
      });
    },
    deleteComment(commentId) {
      axios.delete('/comments/' + commentId).then(() => {
        for (let blog of this.blogs) {
          const commentIndex = blog.comments.findIndex((comment) => comment.id === commentId);
          if (commentIndex !== -1) {
            blog.comments.splice(commentIndex, 1);
            break;
          }
        }
      }).catch((error) => {
        console.log(error);
      });
    }
  }
};
</script>

