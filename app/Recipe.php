<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
}
