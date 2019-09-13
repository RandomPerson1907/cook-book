@extends('layouts.app')
@push("styles")
    <link rel="stylesheet" href="{{ asset('/css/ingredients/create.css') }}">
@endpush

@section('content')
    <form action="{{ route("ingredients.store") }}" method="POST">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-left">Добавление Ингредиента</h1>
                </div>
            </div>
            <div class="row mt-5 pb-5 border-bottom">
                <div class="col-md-3">
                    <label for="ingredient-input">Название</label>
                </div>
                <div class="col-md-5">
                    <input
                        id="ingredient-input"
                        class="form-control"
                        name="name"
                        type="text"
                        placeholder="Введите наименование..."
                        value="{{ old('name') }}"
                    >
                </div>
            </div>
            <div class="row justify-content-end mt-5">
                <div class="col-md-3">
                    <input type="submit" class="w-100 btn btn-primary" value="Сохранить">
                </div>
            </div>
        </div>
    </form>
@endsection
