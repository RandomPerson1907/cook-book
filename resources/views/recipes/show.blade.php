@extends('layouts.app')
@push("styles")
    <link rel="stylesheet" href="{{ asset('/css/recipes/show.css') }}">
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
            <div class="col-md-12 d-flex">
                <h1 class="text-left mr-3">{{ $recipe->name }}</h1>
                <a class="button__add" href="{{ route("recipes.edit", $recipe->id) }}">
                    <img class="w-100 h-100" src="{{ asset("/img/icons/edit.png") }}" alt="Delete">
                </a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="recipe">
                    {{ $recipe->description }}
                </div>
            </div>
        </div>
        <div class="row mt-5 border-bottom">
            <div class="col-md-12">
                <div class="ingredients__header">
                    <h2>Ингредиенты</h2>
                </div>
            </div>
        </div>
        @forelse($recipe->ingredients()->get() as $ingredient)
            <show-ingredient
                recipe-id="{{ $recipe->id }}"
                :ingredient="{{ json_encode($ingredient) }}"
                route="{{ route("ingredient.updateCount") }}"
            ></show-ingredient>
        @empty

        @endforelse
    </div>
@endsection
