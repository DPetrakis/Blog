<template>
 <div v-if="categories.length">
 <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(category,index) in categories" v-bind:key="category.id">
      <td scope="row">{{index + 1}}</td>
      <td>{{category.name}}</td>
      <td><button @click="FetchCategory(category.id)"  type="button" data-toggle="modal" data-target="#CategoryModal" class="btn btn-primary">Edit</button></td>
      <td><button @click="DeleteCategory(category.id)" type="button"  class="btn btn-danger">Delete</button></td>
    </tr>
  </tbody>
 </table>
 <!-- Pagination -->
 <ul class="pagination justify-content-center mt-4">
      <li  class="page-item">
          <a @click="FetchCategories(pagination.prev_page_url)" class = "page-link" href="#">&larr;Previous</a>
      </li>
      <li  class="page-item">
        <a @click="FetchCategories(pagination.next_page_url)" class="page-link" href="#">Next &rarr;</a>
      </li>
  </ul>
 <edit-category :category="category"> </edit-category>
 <button data-toggle = "modal" data-target = "#CreateCategoryModal" type="button" class="btn btn-success">Create</button>
 <create-category v-on:getcategory ="ServeCategory($event)"></create-category>
 </div>
 

</template>
<script>
export default {
    data() {
        return {
            pagination: {},
            categories: [],
            category: "",
            api_token: window.Laravel.api_token
        }
    },
    mounted() {
        this.FetchCategories();
    },
    methods: {
        FetchCategories: function(page_url) {
              let vm = this;
              page_url = page_url || '../api/categories'
              axios({
                method: 'get',
                url:  page_url
               })
              .then((response) => {
                 
                  this.categories = response.data.data;
                   vm.MakePagination(response.data.meta,response.data.links);
              }, (error) => {
                    console.log(error);
              });
        },

        DeleteCategory: function(id){
              
              axios({
                method: 'delete',
                url:  "../api/categories/" + id,
                headers: {
                   Authorization: 'Bearer ' + this.api_token
                }
               })
              .then((response) => {
                console.log(response);
                this.FetchCategories();
              }, (error) => {
                    console.log(error);
              });
        },
        FetchCategory: function(id){
              
              axios({
                method: 'get',
                url:  "../api/categories-data/" + id,
               })
              .then((response) => {
                console.log(response);
                this.category = response.data.data;
              }, (error) => {
                    console.log(error);
              });
        },

        ServeCategory: function($event) {
          this.FetchCategories();
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