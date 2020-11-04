<template>
    
  <!-- Create Category Modal -->
<div class="modal fade" id="CreateCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form>
             <div class="form-group">
             <label for="exampleInputEmail1">Name</label>
             <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Ex Perfomance,Exercise.." v-model="category_name">
             </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button @click="CreateCategory()" id="AddCategory" type="button" class="btn btn-primary" data-dismiss = "modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

</template>
<script>
export default {
    data(){
        return {
            category_name: "",
            api_token:  window.Laravel.api_token,
            categories: [],
          
        }
    },
    methods: {
        CreateCategory: function(){
               axios({
                method: 'post',
                url:  "../api/categories",
                headers: {
                    Authorization: 'Bearer ' + this.api_token,
                 
                },
                data: {
                    category_name: this.category_name
                }
               })
              .then((response) => {
                
                console.log(response);
                this.$emit('getcategory',{'category': "Category created"});
                this.category_name = ""
              }, (error) => {
                   if(error.response.status == 422) {

                     this.errors = error.response.data.errors;

                   }
              });
        },
       
    }
}
</script>