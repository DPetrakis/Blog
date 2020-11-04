<template>
  
  <div>
     <table class="table">
        <thead>
         <tr>
         <th scope="col">#</th>
         <th scope="col">Tag</th>
         <th scope="col">Created_at</th>
         <th scope="col">Edit</th>
         <th scope="col">Delete</th>
         </tr>
        </thead>
        <tbody>
        <tr v-for="(tag,index) in tags" v-bind:key="tag.id">
          <td>{{index + 1}}</td>
          <td>{{tag.name}}</td>
          <td>{{tag.created_at}}</td>
          <td><button @click="FetchTag(tag.id)" type="button" data-toggle="modal" data-target="#TagModal" class="btn btn-primary">Edit</button></td>
          <td><button @click="DeleteTag(tag.id)" type="button"  class="btn btn-danger">Delete</button></td>
        </tr>
        </tbody>
      </table>
       <!-- Pagination -->
        <ul class="pagination justify-content-center mt-4">
          <li  class="page-item">
            <a @click="FetchTags(pagination.prev_page_url)" class = "page-link" href="#">&larr;Previous</a>
          </li>
          <li  class="page-item">
            <a @click="FetchTags(pagination.next_page_url)" class="page-link" href="#">Next &rarr;</a>
          </li>
        </ul>
       <button data-toggle = "modal" data-target = "#CreateTagModal" type="button" class="btn btn-success">Create</button>
       <edit-tag :tag="tag"></edit-tag>
       <create-tag v-on:gettag ="ServeTag($event)"></create-tag>
  </div>
    
</template>
<script>
export default {
   data() {
     return {
       tags: [],
       tag: "",
       api_token: window.Laravel.api_token,
     }
   },

   mounted() {
     this.FetchTags();
   },

   methods:{
     FetchTags: function(page_url){
          let vm = this;
          page_url = page_url || '../api/tags'
          axios({
            method: 'get',
            url:  page_url
          })
          .then((response) => {
            this.tags = response.data.data;
            vm.MakePagination(response.data.meta,response.data.links)
          }, (error) => {
            console.log(error);
          });
      },

      DeleteTag: function(id){
          axios({
                method: 'delete',
                url:  "../api/tags/" + id,
                headers: {
                    Authorization: 'Bearer ' + this.api_token
                }
          })
          .then((response) => {
              console.log(response);
              this.FetchTags();
          }, (error) => {
              console.log(error);
          });  
      },

      FetchTag: function(id){
           
              axios({
                method: 'get',
                url:  "../api/tags/" + id,
               })
              .then((response) => {
                console.log(response);
                this.tag = response.data.data;
              }, (error) => {
                    console.log(error);
              });
        },

      ServeTag: function($event){
        this.FetchTags();
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
    }
}
</script>

<style>

</style>