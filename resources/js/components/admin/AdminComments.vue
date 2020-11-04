<template>
 <div v-if="comments.length">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Comment</th>
      <th scope="col">By</th>
      <th scope="col">Created_at</th>
      <th scope="col">Related_to</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(comment,index) in comments" v-bind:key="comment.id">
      <td scope="row">{{index + 1}}</td>
      <td class="comment-description">{{comment.description}}</td>
      <td class = "user-email">{{comment.user.email}}</td>
      <td>{{comment.created_at}}</td>
      <td>{{comment.post.title}}</td>
      <td><button @click="DeleteComment(comment.id)" type="button"  class="btn btn-danger">Delete</button></td>
    </tr>
  </tbody>
  
 </table>
 <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
          <li  class="page-item">
            <a @click="FetchComments(pagination.prev_page_url)" class = "page-link" href="#">&larr;Previous</a>
          </li>
          <li  class="page-item">
            <a @click="FetchComments(pagination.next_page_url)" class="page-link" href="#">Next &rarr;</a>
          </li>
        </ul>
 </div>

</template>
<script>
export default {
    data(){
      return {
        comments: [],
        api_token: window.Laravel.api_token,
        pagination: {}
      
      }
    },
    mounted(){
      this.FetchComments();
    },
    methods: {
      FetchComments: function(page_url){
           let vm = this;
           page_url = page_url || '../api/comments'
           axios({
                method: 'get',
                url:  page_url
                
           })
            .then((response) => {
               this.comments = response.data.data;
               vm.MakePagination(response.data.meta,response.data.links)
            }, (error) => {
                    console.log(error);
            });
      },
      DeleteComment: function(id){
           axios({
                method: 'delete',
                url:  "../api/comments/" + id,
                headers: {
                   Authorization: 'Bearer ' + this.api_token
                }
               })
              .then((response) => {
                console.log(response);
                this.FetchComments();
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
      

    }, 
   
}
</script>
<style>
 .user-email {
   color: #3490dc;
 }
</style>