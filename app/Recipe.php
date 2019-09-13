<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Recipe extends Model
{
    protected $fillable = ["name", "description", "user_id"];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public static function getAll($request)
    {
        return self::
            where("user_id", $request->user()->id)
            ->orderBy(isset($request->orderBy) ? $request->orderBy : "id")
            ->paginate(isset($request->paginate) ? $request->paginate : 15);
    }

    public static function getOne($request, $id)
    {
        return self::where("id", "=", $id)
            ->where("user_id", "=", $request->user()->id)->first();
    }

    public static function isValid($parameters, $exceptId = false)
    {
        $validator = Validator::make($parameters, [
            "name" => "required|max:191|unique:ingredients" . ($exceptId === false ? "" : ",{$exceptId}"),
            "description" => "required|max:40000"
        ], self::messages());

        return $validator;
    }

    public static function messages()
    {
        return [
            'name.required' => 'Вы не ввели имя рецепта',
            'name.max' => 'Максимальная длина имени ингредиента не должна превышать 191 символ',
            'name.unique' => 'Данный ингредиент уже существует',
            'description.required' => 'Вы не ввели описание рецепта',
            'description.max' => 'Максимальная длина описания ингредиента не должна превышать 40000 символов',
            'recipeIngredients.required' => 'Вы не добавили ингридиенты',
            'recipeIngredientsCount.required' => 'Вы не ввели указали количество ингридиента',
        ];
    }
}
