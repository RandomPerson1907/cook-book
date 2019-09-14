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
        return $this->belongsToMany(Ingredient::class)->withPivot('ingredient_count');
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public static function getAll($request)
    {
        $orderBy = isset($request->orderBy) ? $request->orderBy : "id";
        $direction = isset($request->direction) ? ($request->direction === "ASC" || $request->direction === "DESC") ? $request->direction : "ASC" : "ASC";
        return self::
            where("user_id", $request->user()->id)
            ->orderBy($orderBy, $direction)
            ->get();
    }

    public static function getOne($request, $id)
    {
        return self::where("id", "=", $id)
            ->where("user_id", "=", $request->user()->id)->first();
    }

    public static function isValid($parameters, $exceptId = false)
    {
        $validator = Validator::make($parameters, [
            "name" => "required|max:191|unique:recipes" . ($exceptId === false) ? "" : ",{$exceptId}",
            "description" => "required|max:40000",
        ], self::messages());

        return $validator;
    }

    public static function messages()
    {
        return [
            'name.required' => 'Вы не ввели имя рецепта',
            'name.max' => 'Максимальная длина имени рецепт не должна превышать 191 символ',
            'name.unique' => 'Данный рецепт уже существует',
            'description.required' => 'Вы не ввели описание рецепта',
            'description.max' => 'Максимальная длина описания рецепта не должна превышать 40000 символов'
        ];
    }
}
