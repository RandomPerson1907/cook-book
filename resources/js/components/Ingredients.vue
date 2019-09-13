<template>
    <div class="ingredients">
        <div class="row mt-5 pb-5 border-bottom" v-for="(recipeIngredient, recipeIndex) in recipeIngredients">
            <div class="col-md-5">
                <select class="w-100 form-control" name="recipeIngredients[]">
                    <option
                        v-for="(ingredient, index) in ingredients"
                        :value="ingredient.id"
                    >{{ ingredient.name}}</option>
                </select>
            </div>
            <div class="col-md-3">
                <input
                    class="form-control"
                    type="text" name="recipeIngredientsСount[]" placeholder="Введите количество...">
            </div>
            <div class="col-md-1">
                <input
                    type="button"
                    class="form-control" @click="removeRecipeIngredient(recipeIndex)"
                ><img class="w-100 h-100" src="/img/icons/cross.png" alt="Delete">
            </div>
        </div>
        <div class="row mt-5 pb-5 border-bottom">
            <div class="col-md-3">
                <!-- Button trigger modal -->
                <button type="button" class="w-100 btn btn-primary" @click="addIngredientForm">
                    Добавить
                </button>
            </div>
            <div class="offset-md-4 col-md-2">
                <p class="text-right">Нет в списке?</p>
            </div>
            <div class="col-md-3">
                <add-new-ingredient :route="route" @addIngredient="addIngredient"></add-new-ingredient>
            </div>
        </div>
    </div>
</template>

<script>
    import AddNewIngredient from "./AddNewIngredient";

    export default {
        name: "Ingredients",
        components : {
            AddNewIngredient
        },
        props: ["ingredients", "route"],
        data: function() {
            return {
                "recipeIngredients" : []
            }
        },
        methods: {
            addIngredientForm() {
                this.recipeIngredients.push([]);
            },
            removeRecipeIngredient(recipeIndex) {
                this.recipeIngredients.splice(recipeIndex, 1);
            },
            addIngredient(ingredient) {
                this.ingredients.push(ingredient);
            }
        }
    }
</script>

<style scoped>

</style>
