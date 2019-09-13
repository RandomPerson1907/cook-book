<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Ingredient extends Model
{
    protected $fillable = ["name"];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }

    public static function isValid($parameters, $exceptId = false)
    {
        $validator = Validator::make($parameters, [
            "name" => "required|max:191|unique:ingredients" . ($exceptId === false ? "" : ",{$exceptId}")
        ], self::messages());

        return $validator;
    }

    public static function messages()
    {
        return [
            'name.required' => 'Вы не ввели имя ингредиента',
            'name.max' => 'Максимальная длина имени ингредиента не должна превышать 191 символ',
            'name.unique' => 'Данный ингредиент уже существует'
        ];
    }
}
