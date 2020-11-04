<template>
    <div>
       <table class="table">
        <thead>
         <tr>
         <th scope="col">#</th>
         <th scope="col">Post</th>
         <th scope="col">Posted By</th>
         <th scope="col">Created_at</th>
         <th scope="col">Category</th>
         <th scope="col">Delete</th>
         </tr>
        </thead>
        <tbody>
        <tr v-for="(post,index) in posts" v-bind:key="post.id">
        <td scope = "row">{{index + 1}}</td>
        <td><a v-bind:href="'posts/'+ post.id + '/edit/'" id="post-title">{{post.title}}</a></td>
        <td class="author-email">{{post.author.email}}</td>
        <td>{{post.created_at}}</td>
        <td class="post-category">{{post.category.name}}</td>
        <td><button @click="DeletePost(post.id)"  type="button"  class="btn btn-danger">Delete</button></td>
       
        </tr>
        </tbody>
        </table>
        <!-- Pagination -->
        <ul class="pagination justify-content-center mt-4">
          <li  class="page-item">
            <a @click="FetchPosts(pagination.prev_page_url)" class = "page-link" href="#">&larr;Previous</a>
          </li>
          <li  class="page-item">
            <a @click="FetchPosts(pagination.next_page_url)" class="page-link" href="#">Next &rarr;</a>
          </li>
        </ul>
        <hr>
        <create-post v-on:getpost ="FetchPost($event)"></create-post>
    </div>
    
</template>
<script>
export default {
    
    data(){
        return {
          
            posts: [],
            pagination: {},
            api_token: window.Laravel.api_token,
            display: "none",
        }
    },

    mounted(){
        this.FetchPosts();
    },  
    methods: {
        FetchPosts: function(page_url){
            let vm = this;
            page_url = page_url || '../api/posts'
            axios({
                method: 'get',
                url:  page_url
               
               })
              .then((response) => {
                console.log(response);
                this.posts = response.data.data;
                vm.MakePagination(response.data.meta,response.data.links)
              }, (error) => {
                    console.log(error);
            }); 
          
        },
        DeletePost: function(id){
             axios({
                method: 'delete',
                url:  "../api/posts/" + id,
                headers: {
                   Authorization: 'Bearer ' + this.api_token
                }
               })
              .then((response) => {
                console.log(response);
                this.FetchPosts();
              }, (error) => {
                    console.log(error);
              });  
        },

        MakePagination: function(meta,links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }

            this.pagination = pagination;
        },

        FetchPost: function($event){
              
              //Add the post created from create post component 
              this.FetchPosts();
        }   

        

        
    }
}
</script>
<style>
    .author-email {
         color: #3490dc;
    }

    .post-category {
        color: #3490dc;
    }

    #post-title {
        color: #3490dc !important;
    }
</style>