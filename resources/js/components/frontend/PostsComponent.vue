<template>
  
  <div>

        <div class="all-blog-posts">
              <div class="row">
                <div class="col-lg-12">
                  <div class="blog-post" v-for="post in posts" v-bind:key="post.id">
                    <div class="blog-thumb">
                      <img class="posts-image" alt=""  :src="'/Performance/public/images/' + post.image">
                    </div>
                    <div class="down-content">
                      <span>{{post.category.name}}</span>
                      <a v-bind:href="'post/'+ post.id"><h4>{{post.title}}</h4></a>
                      <ul class="post-info">
                        <li><a href="#" class="author-name">By {{post.author.name}}</a></li>
                        <li><a href="#">{{post.created_at}}</a></li>
                        <li><a href="#" v-if="post.comments.length">{{post.comments.length}} Comments</a></li>
                      </ul>
             
                      <div class="post-options">
                        <div class="row">
                          <div class="col-6">
                              <ul class="post-tags mt-2">
                                <li v-for="tag in post.tags" v-bind:key="tag.id">
                                  <a href="#" class="post-tag">#{{tag.name}}</a>
                                </li>
                              </ul>
                          </div>
                          <div class="col-6">
                              
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                
             
              </div>
            </div>
        <ul class="pagination justify-content-center mb-4">
          <li  class="page-item">
            <a @click="FetchPosts(pagination.prev_page_url)" class = "page-link" href="#">&larr;Previous</a>
          </li>
          <li  class="page-item">
            <a @click="FetchPosts(pagination.next_page_url)" class="page-link" href="#">Next &rarr;</a>
          </li>
        </ul>

  </div>
    
         
       
     
       
</template>
<script>

export default {
    data(){
        return {
            posts: [],
            pagination: {},
           
          
        }
    },
    
    mounted() {
       this.FetchPosts();
      
     
    },

    methods: {
      FetchPosts: function(page_url) {
           let vm = this;
           page_url = page_url || '../public/api/posts'
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

      MakePagination: function(meta,links) {
        let pagination = {
          current_page: meta.current_page,
          last_page: meta.last_page,
          next_page_url: links.next,
          prev_page_url: links.prev
        }

        this.pagination = pagination;
      }
    },

   

    
}

</script>
<style>
 .post-tag{
   color: #3490dc !important;
 }

 #post-link {
   color: #ffffff !important;
 }

 .posts-image{
   max-height: 400px;
  
 }
</style>