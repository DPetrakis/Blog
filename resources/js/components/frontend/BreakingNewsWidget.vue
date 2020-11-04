<template>
    <div class="content">
        <ul>
            <li v-for="post in NewsToShow" v-bind:key="post.id"><a href="#">
            <a v-bind:href="url + post.id" ><h5>{{post.title}}</h5></a>
             <img alt="" class="breaking-news-image"  :src="'/Performance/public/images/' + post.image"><br>
            <span>{{post.created_at}}</span>
            
            </a></li>
            <div class="col-lg-12">
            <div class="main-button">
                  <a  @click="IncreaseLimit()" href="#" class="show-more">Show more</a>
            </div>
            </div>
        </ul>
        
    </div>
</template>
<script>
export default {
    props: {
      page: String
    },
    data(){
        return {
            breaking_news: [],
            breaking_news_url: "../post/",
            
            //This variable will be used for show more feature
            limitNumber:3
        }
    },

    mounted(){
        this.FetchBreakingNews();
    },

    methods: {
        FetchBreakingNews(){
               axios({
                    method: 'get',
                    url:  '/Performance/public/api/breaking-news'
          
                })
                .then((response) => {
            
                    console.log(response);
                    this.breaking_news = response.data.data;
          
                }, (error) => {
                  console.log(error);
              });
        },

        IncreaseLimit: function() {
          this.limitNumber = this.limitNumber + 2;
        },

        DecreaseLimit: function() {
          this.limitNumber = this.limitNumber - 2;
        },
    },
    computed: {
      url: function(){
        if(this.page == 'index'){
          this.breaking_news_url = 'post/';
          return this.breaking_news_url;
        }
        else if(this.page == 'post'){
          this.breaking_news_url = '../post/';
          return this.breaking_news_url;
        }
        else {
          return this.breaking_news_url;
        }
      },

    NewsToShow: function() {
        return this.breaking_news.slice(0,this.limitNumber);

    }
  }
}
</script>
<style>
 

  .breaking-news-image {
      height: 100px;
      width: 150px;
  }
</style>