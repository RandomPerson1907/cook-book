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
    public function index()
    {
        return view("ingredients.index", [
            "ingredients" => Ingredient::all()
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

            $ingredient->save();

            return redirect()->route("ingredients.index")->with("status", "Ингредиент успешно сохранен");
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
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $ingredient = Ingredient::find($id);

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
        $ingredient = Ingredient::find($id);

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
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);

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
