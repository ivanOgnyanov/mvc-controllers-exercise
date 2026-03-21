@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-person-plus me-2"></i>Регистрация</h4>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <!-- Име -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Име</label>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Въведи името си"
                                   value="{{ old('name') }}">
                        </div>

                        <!-- Имейл -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Имейл</label>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Въведи имейл адрес"
                                   value="{{ old('email') }}">
                        </div>

                        <!-- Парола -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Парола</label>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Въведи парола">
                        </div>

                        <!-- Повторение на паролата -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Повтори паролата</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control" placeholder="Повтори паролата">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-person-plus me-2"></i>Регистрирай се
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
