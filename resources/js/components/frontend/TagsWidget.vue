<template>
    <div class="content">
        <ul>
           <li><a href="#" v-for="tag in tags" v-bind:key="tag.id">{{tag.name}}</a></li>
                        
        </ul>
    </div>
</template>
<script>
export default {
    data(){
        return {
            tags: [],

        }
    },
    mounted(){
        this.FetchTags();
    },

    methods: {
        FetchTags:function(){
             axios({
                method: 'get',
                url:  '/Performance/public/api/tags'
          
              })
              .then((response) => {
            
                    console.log(response);
                    this.tags = response.data.data;
          
                }, (error) => {
                  console.log(error);
              });
        }
    }
}
</script>
<style>

</style>