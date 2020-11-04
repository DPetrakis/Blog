<template>

<div class="container-fluid"> 
  <div class="row" >
   <div v-for="featuredpost in featuredposts" v-bind:key="featuredpost.id" class="card col-xs-12 col-lg-6 mb-4 p-0">
    <img class="card-img" :src="'/Performance/public/images/' + featuredpost.image" > 
     <div class="card-img-overlay">
        
            <h5 class="card-title">{{featuredpost.category.name}}</h5>
            <a v-bind:href="'post/'+ featuredpost.id"><p class="card-text">{{featuredpost.title}} </p></a>
           
     
      </div>
     </div>
   </div>
  </div> 
</template>
<script>
export default {
    data(){
        return {
           
            featuredposts: []
        }
    },

    mounted(){
        this.FetchFeaturedPosts();
    },
    methods: {
        FetchFeaturedPosts: function(){
          axios({
          method: 'get',
          url:  '/Performance/public/api/featured-posts'
          
          })
          .then((response) => {
              this.featuredposts = response.data.data;
              console.log(response);
           }, (error) => {
            console.log(error);
           });
        }
    }
}
</script>



<style scoped>
 .card-img{
     height: 400px;
     opacity: 95%;
 }

 .card-title {
     margin-top: 200px;
     color: #f48840;
 }

 .card-text {
     color: #ffffff;
     font-weight: 700;
     font-size: 18px;
	 text-transform: uppercase;
     letter-spacing: 0.25px;
 }

 
 .card:hover{
    transform: scale(1.1);
    opacity: 100%;
 }

</style>
