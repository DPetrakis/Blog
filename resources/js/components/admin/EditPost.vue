<template>
   <form @submit.prevent="EditPost()" enctype="multipart/form-data">
   <div v-if="message" class="alert alert-success" role="alert">
      {{message}}
   </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Title</label>
      <input type="text" class="form-control" v-model="post.title">
      <div v-if="errors.title" class="alert alert-danger mt-3" role="alert">
         {{errors.title[0]}}
      </div>
    </div>
    <div class="form-group col-md-6">
      <label for="exampleFormControlSelect1">Category</label>
      <select class="form-control" v-model="post.category_id" >
       <option v-for="category in categories" v-bind:value="category.id" v-bind:key="category.id">{{category.name}}</option>
      </select>
    </div>
  </div>

  <label for="exampleFormControlTextarea1">Content</label>
  <div id="editor">
  </div>
  <div v-if="errors.description" class="alert alert-danger mt-3" role="alert">
     {{errors.description[0]}}
  </div>
  <div class="form-row mt-4">
   <div class="form-group col-md-6">
      <label for="exampleFormControlSelect1">Selected tags</label>
         <ejs-multiselect v-model = selectedvalues  :allowCustomValue='allowCustomValue'   id='multiselect' :dataSource='tags' :fields='fields' placeholder="Select tags"></ejs-multiselect>
     
     
    <!-- <select class="form-control" v-model="post.tag_id" >
       <option v-for="tag in tags" v-bind:key="tag.id" v-bind:value="tag.id">{{tag.name}}</option>
      </select>
      <div v-if="errors.tag_id" class="alert alert-danger mt-3" role="alert">
         {{errors.tag_id[0]}}
      </div>
      <div v-if="errors.tags" class="alert alert-danger mt-3" role="alert">
         {{errors.tags[0]}}
      </div> -->
  

    
    </div>
    <div class="form-group col-md-6">
      <label for="exampleFormControlSelect1">Breaking news?</label>
      <select class="form-control" v-model="post.breaking_news">
         <option v-bind:value="0">NO</option>
         <option v-bind:value="1">YES</option>
      </select>
      <div v-if="errors.breaking_news" class="alert alert-danger mt-3" role="alert">
         {{errors.breaking_news[0]}}
      </div>
    </div>
    
  </div>
   
  <div class="blog-thumb mt-4" v-if="post.image">
      <img class="edit-image" alt=""  :src="'/images/' + post.image">
  </div>  

  <div class="form-group mt-4">
      <label>Upload an image</label><br>
      <input  type="file" id="file" ref="file" @change="SelectFile">
  </div> 

  <button  type="submit" class="btn btn-primary">Sumbit</button>
</form>
</template>
<script>
import Vue from 'vue';
import { MultiSelectPlugin } from "@syncfusion/ej2-vue-dropdowns";
Vue.use(MultiSelectPlugin);
export default {
    props:{
        post_id: ""
    },
    data(){
        return {
             
            //Categories for select options
            categories: [],
            //tags for select options
            tags: [],
            fields : { text: 'name', value: 'id' },
            allowCustomValue : true,
            post: {
                title: "",
                description: "",
                category_id: "",
                image: null,
                tags: [],
                breaking_news: ""
               
            },
            admin: window.Laravel.admin,
            api_token: window.Laravel.api_token,
            errors:[],
            message: "",
            //In this array we will store the values for multiselect 
            selectedvalues: [],
           
            
        }
    },
    mounted(){
      
      this.FetchPost();
      this.FetchCategories();
      this.FetchTags();
    
    },
    methods: {
        FetchPost: function(){
           var editor = new FroalaEditor('#editor');
           axios({
            method: 'get',
            url:  '/api/posts/' + this.post_id
          
            })
           .then((response) => {
             console.log(response);
             this.post.title = response.data.data.title;
             this.post.description = response.data.data.description;
             this.post.category_id = response.data.data.category.id;
             this.post.tags = response.data.data.tags;
             this.CreateMultiValue(this.post.tags);
           //  this.post.tag_id = response.data.data.tags[0].id;
             this.post.breaking_news = response.data.data.breaking_news;
             this.post.image = response.data.data.image;
            
             editor.html.set(this.post.description);
            
          
            }, (error) => {
                console.log(error);
            });
        },
         FetchCategories: function() {
              axios({
                method: 'get',
                url:  "/api/categories"
               })
              .then((response) => {
                     this.categories = response.data.data;
              }, (error) => {
                    console.log(error);
              });
        },

        FetchTags: function(){
            axios({
                method: 'get',
                url:  "/api/tags"
            })
            .then((response) => {
              this.tags = response.data.data;
              
            }, (error) => {
                    console.log(error);
            });
        },

        SelectFile: function(event) {
          
          this.post.image =  event.target.files[0];
          

        },
        EditPost: function(){
           
             var editor = new FroalaEditor('#editor');
             this.post.description = editor.html.get();
             
             //Set data
             let data = new FormData();
             data.append('title', this.post.title);
             data.append('description',this.post.description);
             data.append('image',this.post.image);
             data.append('category_id',this.post.category_id);
             data.append('admin_id',this.admin.id);
             data.append('tags',JSON.stringify(this.selectedvalues));
             data.append('breaking_news',this.post.breaking_news);

             //Set headers
             let axiosConfig = {
                headers: {
                    Authorization: 'Bearer ' + this.api_token
                }
              };

              
               axios.post('/api/posts/' + this.post_id,data,axiosConfig)
               .then((response) => {
                  this.$emit('getpost',{'post': "Post created"});

                 //Clear form inputs
                  this.post.title = "";
                  this.post.description = "";
                  this.post.image = "";
                  this.post.category_id = "";
                  this.post.tag_id = "";
                  this.post.breaking_news = "";
                  this.selectedvalues = "";
                  editor.html.set('');
                  this.message = "This post has been edited";
               }).catch((error) =>{
                  if(error.response.status == 422) {
                      this.errors = error.response.data.errors;
                      console.log(this.errors);
                  }
               }) 


        },

      /*  This method creates the array for the multiselect value,
        we couldnt use post.tags cause they where fetched as an object thats
        why we need this method */
        CreateMultiValue: function(tags){
            tags.forEach(element => {
              this.selectedvalues.push(element.id);
            });
        } 

    }
}
</script>
<style>
  .edit-image{
    height:400px;
    width:800px;
  }
</style>