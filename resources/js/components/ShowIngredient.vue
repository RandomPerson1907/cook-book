<template>
    <div class="ingredient">
        <div class="alert alert-success" role="alert" v-if="status">
            {{ status }}
            <button class="no-border btn__custom" @click="clearStatus"><img src="/img/icons/cross.png" alt="Delete"></button>
        </div>

        <div class="alert alert-warning" role="alert" v-if="error">
            {{ error }}
            <button class="no-border btn__custom" @click="clearError"><img src="/img/icons/cross.png" alt="Delete"></button>
        </div>
        <div class="row mt-3 border-bottom pb-3">
            <div class="col-md-8">
                <div class="ingredient__name">
                    <p>{{ ingredient.name }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ingredient__count">
                    <p @click="changeShowType" v-if="showAsText">{{ ingredientCount }}</p>
                    <input
                        class="form-control"
                        v-else type="text"
                        @keyup.esc="changeShowType"
                        @keyup.enter="changeIngredientCount(ingredient.id)"
                        v-model="ingredientCount"
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShowIngredient",
        props : ["ingredient", "route", "recipeId"],
        data: function() {
            return {
                "ingredientCount" : '',
                "showAsText" : true,
                "status" : "",
                "error" : ""
            }
        },
        created() {
            this.ingredientCount = this.ingredient.pivot.ingredient_count
        },
        methods : {
            changeShowType() {
              this.showAsText = !this.showAsText;
            },
            changeIngredientCount(id) {
                this.clearError();
                this.clearStatus();

                axios.post(this.route, {
                    id : id,
                    count : this.ingredientCount,
                    recipeId : this.recipeId
                })
                .then((response) => {
                    if (response.data.result) {
                        this.changeShowType();
                        this.status = response.data.message;
                    } else {
                        this.error = response.data.message;
                    }
                })
                .catch((error) => {
                    this.error = error;
                });
            },
            clearError() {
                this.error = "";
            },
            clearStatus() {
                this.status = "";
            }
        }
    }
</script>

<style scoped>

</style>
