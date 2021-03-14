<template>
     <div>

    <div v-if="posts" class="all-blog-posts">
        <div class="row">
            <div class="col-lg-12">
              <div class="blog-post" v-for="post in posts" v-bind:key="post.id">
                 <div class="blog-thumb">
                      <img alt=""  :src="'/images/' + post.image">
                  </div>
                  <div class="down-content">
                      <span>{{post.category.name}}</span>
                      <a v-bind:href="'../post/'+ post.id"><h4>{{post.title}}</h4></a>
                      <ul class="post-info">
                        <li><a href="#" class="author-name">By {{post.author.name}}</a></li>
                        <li><a href="#">{{post.created_at}}</a></li>
                        <li><a href="#" v-if="post.comments.length">{{post.comments.length}} Comments</a></li>
                      </ul>
                  
                      <div class="post-options">
                        <div class="row">
                          <div class="col-6">
                            <ul class="post-tags">
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

  </div>
</template>
<script>
export default {
     props: ['tag'],

     data(){
         return {
            posts: []
         }
     },

     mounted(){
        this.FetchPosts();
     },
     
     methods: {
        FetchPosts: function(){
          axios({
            method: 'get',
            url:   '../api/posts/tags/'  +  this.tag
          })
          .then((response) => {
            console.log(response);
            this.posts = response.data.data;
          }, (error) => {
            console.log(error);
          });
      },

     }
   
     
}
</script>
<style>

</style>