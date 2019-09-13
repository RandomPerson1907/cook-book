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

    public function user()
    {
        return $this->belongsToMany(User::class);
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
}
