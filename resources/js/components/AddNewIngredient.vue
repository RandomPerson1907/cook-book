<template>
    <div class="add-new-ingredient">
        <!-- Button trigger modal -->
        <button type="button" class="w-100 btn btn-primary" data-toggle="modal" data-target="#addNewIngredient">
            Создать новый ингредиент
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addNewIngredient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form :action="route" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="ingredientInput" class="pt-1">Название</label>
                            </div>
                            <div class="col-md-8">
                                <input
                                    id="ingredientInput"
                                    class="form-control"
                                    type="text"
                                    placeholder="Введите название"
                                    v-model="ingredientName"
                                >
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="addIngredient">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddNewIngredient",
        props : ["route"],
        data : function() {
          return {
              ingredientName : ""
          }
        },
        methods : {
            addIngredient() {
                axios.post(this.route, {
                    name : this.ingredientName
                })
                .then(function (response) {
                    console.log(response)
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>

<style scoped>

</style>
