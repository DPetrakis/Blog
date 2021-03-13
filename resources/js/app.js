/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import BootstrapVue from 'bootstrap-vue';
//src/main.js
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import "../../node_modules/@syncfusion/ej2-base/styles/material.css";
import "../../node_modules/@syncfusion/ej2-inputs/styles/material.css";
import "../../node_modules/@syncfusion/ej2-vue-dropdowns/styles/material.css";
import "../../node_modules/@syncfusion/ej2-buttons/styles/material.css";

require('./bootstrap');

window.Vue = require('vue');
Vue.use(BootstrapVue);



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));



Vue.component('posts-component', require('./components/frontend/PostsComponent.vue').default);

Vue.component('categories-widget', require('./components/frontend/CategoriesWidget.vue').default);

Vue.component('search-widget', require('./components/frontend/SearchWidget.vue').default);



Vue.component('post',require('./components/frontend/Post.vue').default);

Vue.component('category',require('./components/frontend/Category.vue').default);

Vue.component('admin-categories',require('./components/admin/AdminCategories.vue').default);

Vue.component('edit-category',require('./components/admin/EditCategory.vue').default);

Vue.component('create-category',require('./components/admin/CreateCategory.vue').default);

Vue.component('admin-comments',require('./components/admin/AdminComments.vue').default);

Vue.component('admin-posts',require('./components/admin/AdminPosts.vue').default);

Vue.component('create-post',require('./components/admin/CreatePost.vue').default);

Vue.component('admin-tags',require('./components/admin/AdminTags.vue').default);

Vue.component('create-tag',require('./components/admin/CreateTag.vue').default);

Vue.component('admin-blocks',require('./components/admin/AdminBlocks.vue').default);

Vue.component('carousel',require('./components/FrontEnd/Carousel.vue').default);

Vue.component('tags-widget',require('./components/frontend/TagsWidget.vue').default);

Vue.component('breaking-news-widget',require('./components/frontend/BreakingNewsWidget.vue').default);

Vue.component('edit-post',require('./components/admin/EditPost.vue').default);

Vue.component('edit-tag',require('./components/admin/EditTag.vue').default);

Vue.component('create-user',require('./components/admin/CreateUser.vue').default);

Vue.component('dropdown',require('./components/frontend/DropDown.vue').default);

Vue.component('calendar',require('./components/frontend/Calendar.vue').default);

Vue.component('month',require('./components/frontend/Month.vue').default);

Vue.component('tag',require('./components/frontend/Tag.vue').default);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
