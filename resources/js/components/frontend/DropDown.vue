<template>
 <div v-if="categories.length">
     <a v-for="category in categories" v-bind:key="category.id" class="nav-link" v-bind:href="'/Performance/public/categories/' + category.id">
          {{category.name}}                      
     </a>
 </div>
</template>
<script>
export default {
    data(){
        return {
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
    }
}
</script>

<style>

</style>