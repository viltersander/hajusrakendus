import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import BlogIndex from './Pages/BlogIndex.vue';
import BlogCreate from './Pages/BlogCreate.vue';
import BlogEdit from './Pages/BlogEdit.vue';

const routes = [
  {
    path: '/blog',
    name: 'blog.index',
    component: BlogIndex
  },
  {
    path: '/blog/create',
    name: 'blog.create',
    component: BlogCreate
  },
  {
    path: '/blog/:id/edit',
    name: 'blog.edit',
    component: BlogEdit
  }
];

const router = new VueRouter({
  mode: 'history',
  routes
});

export default router;
