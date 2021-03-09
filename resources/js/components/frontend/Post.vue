<template>
 <div>

  
      <div class="all-blog-posts" v-if="post">
              <div class="row">
                <div class="col-lg-12">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img  :src="'/images/' + post.image" alt="">
                    </div>
                  <div class="down-content">
                      <span>{{post.category.name}}</span>
                      <a href="#"><h4>{{post.title}}</h4></a>
                      <ul class="post-info">
                         <li><a href="#" class="author-name">By {{post.author.name}}</a></li> 
                         <li><a href="#">{{post.created_at}}</a></li>
                         <li><a href="#" v-if="post.comments.length">{{post.comments.length}} Comments</a></li>
                      </ul>
                      <div class = "post-content" v-html="post.description"></div>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-6">
                            <ul class="post-tags">
                              
                              <li v-for="tag in post.tags" v-bind:key="tag.id" >
                                <a href="#" class="post-tag">#{{tag.name}}</a>
                              </li>
                            
                            </ul>
                          </div>
                          <div class="col-6">
                            <ul class="post-share">
                           
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div> 
                  
                <div class="col-lg-12">
                  <div class="sidebar-item submit-comment">
                    <div class="sidebar-heading">
                      <h2>Your comment</h2>
                    </div>
                    <div class="content">
                      <form @submit.prevent="SumbitComment()" id="comment" action="#" method="post">
                        <div class="row">
                          
                          <div class="col-lg-12">
                            <fieldset>
                              <textarea  v-model="comment.description" name="message" id=""  rows="6"  placeholder="Type your comment" required></textarea>
                            </fieldset> 
                             <div v-if="errors[0]" class="alert alert-danger mt-3" role="alert">
                                  {{errors[0]}}
                             </div>
                          </div> 
                          <div class="col-lg-12">
                            <fieldset>
                              <button type="submit" id="form-submit" class="main-button">Submit</button>
                            </fieldset>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item comments">
                    <div class="sidebar-heading">
                      <h2 v-if="post.comments.length">{{post.comments.length}} Comments</h2>
                    </div>
                    <div class="content">
                      <ul>
                        <li v-for="comment in post.comments" v-bind:key="comment.id">
                          
                          <div class="right-content">
                            <h4>{{comment.user.name}}<span class="user-email">{{comment.user.email}}</span></h4>
                            <p class="comment-description">{{comment.description}}</p>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div> 

         


 </div>
  

       
</template>
<script>
export default {
    props: {
      post_id: String
    },
   
    data() { 
        return {
            errors: [],
           //In this variable we are going to store our fetched post
            post: null,
            //Comment object to be sumbitted
            comment: {
              description: "",
              
            },
            userj: null,
            api_token: "",
            user_id : ""
          
        }
    },

    mounted(){
      
      this.FetchPost();
   
    },

    methods: {
      FetchPost: function(){
           axios({
            method: 'get',
            url:  '../api/posts/' + this.post_id
          
           })
           .then((response) => {
             this.post = response.data.data;
             console.log(this.post);
          
            }, (error) => {
                console.log(error);
            });
      },

      SumbitComment: function(){
     

          axios({
            method: 'post',
            url:  '/api/comments',
            headers: {
                    Authorization: 'Bearer ' + window.Laravel.api_token
            }, 
            data: {
               post_id: this.post_id,
               user_id: window.Laravel.user.id,
               description: this.comment.description
            }
            })
            .then((response) => {
                
                this.FetchPost();
                console.log(response);
                
            }, (error) => {
              
              if(error.response.status == 401) {
                  
                  this.errors.push('You need to be loged in,in order to make comments');
                
              }
              
            });

            //Clean Form input
            this.comment.description = '';
      },

   


    }
}
</script>
<style>
   
   .user-email {
        color: #3490dc !important;

   }
   
   .author-name {
     color: #3490dc !important;
   }

   .post-content{
     word-break: break-all;
   }

   .comment-description {
     word-break: break-all;
   }
   
</style>