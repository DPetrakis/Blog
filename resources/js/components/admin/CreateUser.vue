<template>
<div>
    <h5>Here you can create an admin</h5>
    <small>We advice you to create only admins with the role of an author and not a new super-admin!</small>
<form @submit.prevent="CreateUser()" class="mt-4">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Username</label>
      <input type="text" class="form-control" v-model="user.username">
      <div v-if="errors.username" class="alert alert-danger mt-3" role="alert">
         {{errors.username[0]}}
      </div>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Email</label>
      <input type="text" class="form-control" v-model="user.email">
      <div v-if="errors.email" class="alert alert-danger mt-3" role="alert">
         {{errors.email[0]}}
      </div>
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="inputAddress">Password</label>
    <input type="password" class="form-control" v-model="user.password">
    <div v-if="errors.password" class="alert alert-danger mt-3" role="alert">
         {{errors.password[0]}}
    </div>
  </div>
  <div class="form-group col-md-6">
    <label>Role</label>
      <select class="form-control" v-model="user.role_id">
            <option v-for="role in roles" v-bind:key = role.id v-bind:value="role.id">{{role.title}}</option>
      </select>
      <div v-if="errors.role_id" class="alert alert-danger mt-3" role="alert">
         {{errors.role_id[0]}}
    </div>
  </div>
  </div>
 
  <button type="submit" class="btn btn-primary">Sumbit</button>
</form>
</div>
</template>
<script>
export default {
    data(){
        return {

            //Store validation errors
            errors: [],
            roles: [],
            api_token: window.Laravel.api_token,
            user: {
                username: "",
                email: "",
                password: "",
                role_id: ""
            },

            admin: window.Laravel.admin
        }
    },

    mounted(){
        this.FetchRoles();

    },

    methods: {
        FetchRoles: function(){
          axios({
            method: 'get',
            url:  '../api/roles/',
            headers:{
               Authorization: 'Bearer ' + this.api_token
            },
          })
          .then((response) => {
             this.roles = response.data.data;
             console.log(this.roles);
          
          }, (error) => {
                console.log(error);
          });
        },

        CreateUser: function(){
             axios({
                method: 'post',
                url:  "/api/admins",
                headers: {
                    Authorization: 'Bearer ' + this.api_token,
                 
                },
                data: {
                    username: this.user.username,
                    email: this.user.email,
                    password: this.user.password,
                    role_id: this.user.role_id,
                    admin: this.admin
                }
               })
              .then((response) => {
                
                console.log(response);
                this.user.username = '',
                this.user.email = '',
                this.user.password = '',
                this.user.role_id = ''
              
              }, (error) => {
                   if(error.response.status == 422) {

                     this.errors = error.response.data.errors;
                     console.log(this.errors);
                   }
              });
        }
    }
}
</script>
<style>

</style>