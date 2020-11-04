<template>
<!-- Create Τag Modal -->
    <div class="modal fade" id="CreateTagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Tag</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
             <form>
                 <div class="form-group">
                 <label for="exampleInputEmail1">Name</label>
                 <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Ex Perfomance,Exercise.." v-model="tag_name">
                 </div>
            </form>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button @click="CreateTag()"  type="button" class="btn btn-primary" data-dismiss = "modal">Save changes</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {

    data(){
        return {
            tag_name: "",
            api_token:  window.Laravel.api_token,
        }
    },
    methods: {
        CreateTag: function(){
             axios({
                method: 'post',
                url:  "../api/tags",
                headers: {
                    Authorization: 'Bearer ' + this.api_token,
                 
                },
                data: {
                    tag_name: this.tag_name
                }
               })
              .then((response) => {
                
                console.log(response);
               
                this.$emit('gettag',{'tag': "Tag created"});

                this.tag_name = ""
              }, (error) => {
                   if(error.response.status == 422) {

                     this.errors = error.response.data.errors;

                   }
              });
        }
    }
}
</script>

<style>

</style>