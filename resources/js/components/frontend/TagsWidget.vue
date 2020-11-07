<template>
    <div class="content">
        <ul>
           <li v-for="tag in tags" v-bind:key="tag.id">
            <a  v-bind:href="url + tag.id">
               {{tag.name}}
               <span v-if="tag.posts.length">({{tag.posts.length}})</span>
            </a>
               
            </li>
                        
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
            tags: [],
            tag_url: ""
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
    },

    computed: {
      url: function(){
        if(this.page == 'index'){

          this.calendar_url = 'tags/';
          return this.calendar_url;

        }
        else if(this.page == 'post'){

          this.calendar_url = '../tags/';
          return this.calendar_url;

        }
         else if(this.page == 'month'){
          this.calendar_url = '../tags/';
          return this.calendar_url;
        }
        else {

          return this.calendar_url;

        }
      }
    }
}
</script>
<style>

</style>