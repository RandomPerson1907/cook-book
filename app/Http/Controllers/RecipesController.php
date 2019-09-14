<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Recipe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;

class RecipesController extends Controller
{
    /**
     * RecipesController constructor.
     */
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view("recipes.index", [
            "recipes" => Recipe::getAll($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        return view("recipes.create", [
            "ingredients" => Ingredient::getAll($request)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function store(Request $request)
    {
        $validator = Recipe::isValid($request->all());
        if (!$validator->fails()) {
            if (count($request->recipeIngredients) !== count($request->recipeIngredientsСount)) {
                $errors = new MessageBag;
                $errors->add("Counts not equal", "Товары и их количество должны совпадать");
                return back()->withInput()->withErrors($errors);
            } else {
                $recipe = new Recipe;
                $recipe->name = $request->name;
                $recipe->description = $request->description;
                $recipe->user_id = $request->user()->id;

                $recipe->save();
                for ($i = 0; $i < count($request->recipeIngredients); $i++) {
                    if (is_null($request->recipeIngredients[$i]) || is_null($request->recipeIngredientsСount[$i])) {
                        $recipe->delete();
                        $errors = new MessageBag;
                        $errors->add("Ingredient count is null", "Количество ингридиента не указано");
                        return back()->withInput()->withErrors($errors);
                    }

                    $ingredient = Ingredient::find($request->recipeIngredients[$i]);

                    if (!$ingredient) {
                        $errors = new MessageBag;
                        $errors->add("Ingredient not found", "Ингредиент не найден");
                        return back()->withInput()->withErrors($errors);
                    }

                    $recipe->ingredients()->attach($ingredient, [
                        "ingredient_count" => $request->recipeIngredientsСount[$i]
                    ]);
                }

                return redirect()->route("recipes.index")->with("status", "Рецепт успешно добавлен");
            }
        } else {
            return back()->withInput()->withErrors($validator->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $recipe = Recipe::getOne($request, $id);

        if (!$recipe) {
            $errors = new MessageBag;
            $errors->add("Not found", "Рецепт не найден");
            return redirect()
                ->route("recipes.index")
                ->withErrors($errors);
        } else {
            return view("recipes.show", [
                "recipe" => $recipe
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $recipe = Recipe::getOne($request, $id);

        if (!$recipe) {
            $errors = new MessageBag;
            $errors->add("Not found", "Рецепт не найден");
            return redirect()
                ->route("recipes.index")
                ->withErrors($errors);
        } else {
            return view("recipes.edit", [
                "ingredients" => Ingredient::getAll($request),
                "recipe" => Recipe::getOne($request, $id)
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $recipe = Recipe::getOne($request, $id);
        $request->recipeIngredients = (isset($request->recipeIngredients)) ? $request->recipeIngredients : [];
        $request->recipeIngredientsСount = (isset($request->recipeIngredientsСount)) ? $request->recipeIngredientsСount : [];

        if (!$recipe) {
            $errors = new MessageBag;
            $errors->add("Not found", "Рецепт не найден");
            return redirect()
                ->route("recipe.index")
                ->withErrors($errors);
        }

        $validator = Recipe::isValid($request->all(), $id);
        if (!$validator->fails()) {
            if (count($request->recipeIngredients) !== count($request->recipeIngredientsСount)) {
                $errors = new MessageBag;
                $errors->add("Counts not equal", "Товары и их количество должны совпадать");
                return back()->withInput()->withErrors($errors);
            } else {
                $recipe->name = $request->name;
                $recipe->description = $request->description;
                $recipe->user_id = $request->user()->id;

                $recipe->ingredients()->detach();
                for ($i = 0; $i < count($request->recipeIngredients); $i++) {
                    if (is_null($request->recipeIngredients[$i]) || is_null($request->recipeIngredientsСount[$i])) {
                        $errors = new MessageBag;
                        $errors->add("Ingredient count is null", "Количество ингридиента не указано");
                        return back()->withInput()->withErrors($errors);
                    }

                    $ingredient = Ingredient::find($request->recipeIngredients[$i]);

                    if (!$ingredient) {
                        $errors = new MessageBag;
                        $errors->add("Ingredient not found", "Ингредиент не найден");
                        return back()->withInput()->withErrors($errors);
                    }

                    $recipe->ingredients()->attach($ingredient, [
                        "ingredient_count" => $request->recipeIngredientsСount[$i]
                    ]);
                }

                $recipe->save();

                return redirect()->route("recipes.index")->with("status", "Рецепт успешно обновлен");
            }
        } else {
            return back()->withInput()->withErrors($validator->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::find($id);

        if (!$recipe) {
            $errors = new MessageBag;
            $errors->add("Recipe not found", "Рецепт не найден");
            return back()->withInput()->withErrors($errors);
        } else {
            $recipe->delete();
            return redirect()->route("recipes.index")->with("status", "Рецепт успешно удален");
        }
    }
}
