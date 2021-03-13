<template>

<div class="content">
    <ul>
        <li v-for="post in posts" v-bind:key="post.id">
        <a v-bind:href="url + post.month">{{Monthname(post.month)}}({{post.count}})</a>
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
         posts: [],
         calendar_url: '../months/'
      }
    },

    mounted(){
        this.FetchPostsByMonth();
    },

    methods:{
        FetchPostsByMonth: function(){
          axios({
            method: 'get',
            url:  '../api/posts-per-month'
          })
          .then((response) => {
                console.log(response);
                this.posts = response.data;
          
           }, (error) => {
                console.log(error);
            });
        },

        Monthname: function(month){

            if(month == 1){

                return 'January';
            }

            if(month == 2){
                return 'February';
            }

            if(month == 3){
                return 'March';
            }

            if(month ==4){
                return 'April';
            }

            if(month ==5){
                return 'May';
            }

            if(month ==6){
                return 'June';
            }

            if(month ==7){
                return 'July';
            }

            if(month == 8){
                return 'August';
            }

            if(month == 9){
                return 'September';
            }

            if (month == 10) {

                return 'Octomber';
            }

            if(month == 11){

                return 'November';
            }

            if(month == 12){

                return 'December';
            }
        }
    },
    computed: {
      url: function(){
        if(this.page == 'index'){

          this.calendar_url = 'months/';
          return this.calendar_url;

        }
        else if(this.page == 'post'){

          this.calendar_url = '../months/';
          return this.calendar_url;

        }
        else {

          return this.calendar_url;

        }
      }
    }
    
    
    
}

</script>