<template>
 <div v-if="blocked_users.length">
   <h4>Blocked users</h4>
   <table class="table">
   <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Unblock</th>
     </tr>
    </thead>
    <tbody>
     <tr v-for="(blocked_user,index) in blocked_users" v-bind:key="blocked_user.id">
      <td scope="row">{{index + 1}}</td>
      <td>{{blocked_user.name}}</td>
      <td class="blocked-email">{{blocked_user.email}}</td>
      <td><button @click="UnBlock(blocked_user.id)"  type="button" class="btn btn-success">Unblock</button></td>
     </tr>
    </tbody>
    </table>
    
 </div>
 
</template>

<script>
export default {
    data(){
      return {
        blocked_users: [],
        api_token: window.Laravel.api_token
         
      }
    },
    mounted(){
      this.FetchBlockedUsers();
     
    },
    methods: {
     
     FetchBlockedUsers: function () {
           axios({
                method: 'get',
                url:  "../api/users/block",
                headers: {
                   Authorization: 'Bearer ' + this.api_token
                }
               })
               .then((response) => {
                  this.blocked_users = response.data.data;
               }, (error) => {
                  console.log(error);
            });
      },
      UnBlock: function (id) {
             
          axios({
            method: 'put',
            url:  "../api/users/block/" + id,
            headers: {
              Authorization: 'Bearer ' + this.api_token
            }
            })
            .then((response) => {
               
              this.FetchBlockedUsers();
             
            }, (error) => {
                  console.log(error);
          });
      },

      
  }
}
</script>

<style>

.blocked-email {
   color:#d9534f;
}

</style>