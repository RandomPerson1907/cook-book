@extends('layouts.app')
@push("styles")
    <link rel="stylesheet" href="{{ asset('/css/recipes/index.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        @if (session("status"))
            <div class="alert alert-success" role="alert">
                {{ session("status") }}
            </div>
        @endif

        @if ($errors->count())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="row">
            <div class="col-md-8">
                <h1 class="text-left">Мои рецепты</h1>
            </div>
            <div class="col-md-3 text-right">
                <a class="btn btn-primary button__add" href="{{ route("recipes.create") }}">Добавить рецепт</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-11">
                <div class="row mt-3 data-row border-bottom pb-3">
                    <div class="col-md-4">
                        <a href="{{ route("recipes.index") }}?orderBy=name{{ isset(request()->orderBy) ? (isset(request()->direction) && request()->direction == "ASC") ? "&direction=DESC" : "&direction=ASC" : "&direction=ASC" }}">Название</a>
                    </div>
                    <div class="col-md-5">
                        <a href="{{ route("recipes.index") }}?orderBy=description{{ isset(request()->orderBy) ? (isset(request()->direction) && request()->direction == "ASC") ? "&direction=DESC" : "&direction=ASC" : "&direction=ASC" }}">Описание</a>
                    </div>
                    <div class="col-md-3">
                        Действия
                    </div>
                </div>
                <div class="recipes data-rows">
                    @forelse ($recipes as $recipe)
                        <div class="data-row ingredient row mt-3 border-bottom">
                            <div class="recipe__name data-row__name col-md-4">
                                {{ $recipe->name }}
                            </div>
                            <div class="recipe__name data-row__name col-md-5">
                                {{ $recipe->description }}
                            </div>
                            <div class="recipe__action data-row__action data-row__action_show recipe__action_show col-md-1 text-right">
                                <a href="{{ route("recipes.show", $recipe->id) }}"><img src="{{ asset("/img/icons/eye.png") }}" alt="Show"></a>
                            </div>
                            <div class="recipe__action data-row__action data-row__action_edit recipe__action_edit col-md-1 text-right">
                                <a href="{{ route("recipes.edit", $recipe->id) }}"><img src="{{ asset("/img/icons/edit.png") }}" alt="Delete"></a>
                            </div>
                            <div class="recipe__action data-row__action recipe__action_delete data-row__action_delete col-md-1 text-right">
                                <form action="{{ route("recipes.destroy", $recipe->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <label>
                                        <input class="d-none" type="submit">
                                        <img src="{{ asset("/img/icons/cross.png") }}" alt="Delete">
                                    </label>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning" role="alert">
                            Рецепты не найдены
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
