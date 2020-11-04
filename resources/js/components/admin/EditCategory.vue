<template>

  
  <!-- Edit Category Modal -->
  <div class="modal fade" id="CategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <form>
          <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="category.name">
          </div>
         </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button @click="UpdateCategory()" type="button" class="btn btn-primary" data-dismiss = "modal">Save changes</button>
        </div>
    </div>
  </div>
  </div>

</template>
<script>
export default {
    props: ['category'],
    data(){
      return {
        api_token : window.Laravel.api_token
      }
    },
    methods: {
      UpdateCategory: function() {
           
            axios({
                method: 'put',
                url:  "../api/categories/" + this.category.id,
                headers:{
                      Authorization: 'Bearer ' + this.api_token
                },
                data: {
                  category_name: this.category.name
                }
               })
              .then((response) => {
             
                console.log(response);
              }, (error) => {
                    console.log(error);
              });
      }     
    }
    
}
</script>
<style>

</style>