@extends('layouts.simple')

@push("styles")
    <link rel="stylesheet" href="{{ asset('/css/auth/login.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/dore/dore.light.blue.min.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-10 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="position-relative image-side ">

                        <p class=" text-white h2">МАГИЯ СКРЫВАЕТСЯ В ДЕТАЛЯХ</p>

                        <p class="white mb-0">
                            Используйте свои данные, чтобы войти.
                            <br>Если Вы еще не зарегистрировались, то быстрее
                            <a href="{{ route("register") }}" class="blue">присоединяйтесь</a>.
                        </p>
                    </div>
                    <div class="form-side">
                        <a href="Dashboard.Default.html">
                            <span class="logo-single"></span>
                        </a>
                        <h6 class="mb-4">Login</h6>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <label class="form-group has-float-label mb-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                                <span>E-mail</span>
                            </label>

                            <label class="form-group has-float-label mb-4">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span>Пароль</span>
                            </label>
                            <div class="d-flex justify-content-between align-items-center">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">Забыли пароль?</a>
                                @endif
                                <button class="btn btn-primary btn-lg btn-shadow" type="submit">Войти</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
