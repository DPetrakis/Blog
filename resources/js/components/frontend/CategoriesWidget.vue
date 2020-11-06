<template>
       
       <div class="content">
            <ul>
                <li v-for="category in categories" v-bind:key="category.id" >
                  <a v-bind:href="url + category.id">{{category.name}}</a>
                  
                </li>
                
            </ul>
        </div>
       
      
       
</template>
<script>
export default {
    props: {
      page: String
    },
    data() {
      return {
        
        category_url: "",
        categories: []
      }
    },

    mounted(){
         
      this.FetchCategories();
    },
    methods: {
      FetchCategories: function(){
        axios({
          method: 'get',
          url:  '/Performance/public/api/categories'
        })
        .then((response) => {
            this.categories = response.data.data;
          
         }, (error) => {
            console.log(error);
        });
      }
    },
    computed: {
      url: function(){
        if(this.page == 'index'){
          this.category_url = 'categories/';
          return this.category_url;
        }
        else if(this.page == 'post'){
          this.category_url = '../categories/';
          return this.category_url;
        }

        else if(this.page == 'month'){
          this.category_url = '../categories/';
          return this.category_url;
        }

        else {
          return this.category_url;
        }
      }
    }
}
</script>
<style>


</style>