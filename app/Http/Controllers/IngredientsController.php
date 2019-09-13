<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;

class IngredientsController extends Controller
{
    /**
     * IngredientsController constructor.
     */
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        return view("ingredients.index", [
            "ingredients" => Ingredient::getAll($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("ingredients.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Ingredient::isValid($request->all());
        if (!$validator->fails()) {
            $ingredient = new Ingredient;
            $ingredient->fill($request->all());
            $ingredient->user_id = $request->user()->id;

            $ingredient->save();

            if($request->ajax()){
                return Response::create([
                    "result" => true,
                    "message" => "Ингредиент успешно сохранен",
                    "ingredient" => [
                        "id" => $ingredient->id,
                        "name" => $ingredient->name
                    ]
                ], 201);
            } else {
                return redirect()->route("ingredients.index")->with("status", "Ингредиент успешно сохранен");
            }
        } else {
            if($request->ajax()){
                return Response::create([
                    "result" => false,
                    "message" => $validator->errors(),
                ]);
            } else {
                return back()->withInput()->withErrors($validator->errors());
            }
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
        $ingredient = Ingredient::getOne($request, $id);

        if (!$ingredient) {
            $errors = new MessageBag;
            $errors->add("Not found", "Ингредиент не найден");
            return redirect()
                ->route("ingredients.index")
                ->withErrors($errors);
        } else {
            return view("ingredients.edit", [
                "ingredient" => $ingredient
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
        $ingredient = Ingredient::getOne($request, $id);

        if (!$ingredient) {
            $errors = new MessageBag;
            $errors->add("Not found", "Ингредиент не найден");
            return redirect()
                ->route("ingredients.index")
                ->withErrors($errors);
        }

        $validator = Ingredient::isValid($request->all());
        if (!$validator->fails()) {
            $ingredient->fill($request->all());
            $ingredient->save();

            return redirect()->route("ingredients.index")->with("status", "Ингредиент успешно сохранен");
        } else {
            return back()->withInput()->withErrors($validator->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $ingredient = Ingredient::getOne($request, $id);

        if (!$ingredient) {
            $errors = new MessageBag;
            $errors->add("Not found", "Ингредиент не найден");
            return redirect()
                ->route("ingredients.index")
                ->withErrors($errors);
        } else {
            $ingredient->delete();
            return redirect()->route("ingredients.index")->with("status", "Ингредиент успешно удален");
        }
    }
}
