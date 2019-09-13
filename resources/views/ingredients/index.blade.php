@extends('layouts.app')
@push("styles")
    <link rel="stylesheet" href="{{ asset('/css/ingredients/index.css') }}">
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
                <h1 class="text-left">Список ингредиентов</h1>
            </div>
            <div class="col-md-3 text-right">
                <a class="btn btn-primary button__add" href="{{ route("ingredients.create") }}">Добавить</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-11">
                <div class="ingredients data-rows">
                    @forelse ($ingredients as $ingredient)
                    <div class="data-row ingredient row mt-3">
                        <div class="ingredient__name data-row__name col-md-10">
                            {{ $ingredient->name }}
                        </div>
                        <div class="ingredient__action data-row__action data-row__action_edit ingredient__action_edit col-md-1 text-right">
                            <a href="{{ route("ingredients.edit", $ingredient->id) }}"><img src="{{ asset("/img/icons/edit.png") }}" alt="Delete"></a>
                        </div>
                        <div class="ingredient__action data-row__action ingredient__action_delete data-row__action_delete col-md-1 text-right">
                            <form action="{{ route("ingredients.destroy", $ingredient->id) }}" method="POST">
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
                            Ингредиенты не найдены
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
