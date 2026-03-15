@extends('layouts.app')

@section('title', 'Начало')

@section('content')

    <main class="container py-5">
        <div class="row">
            <!-- Основно съдържание -->
            <div class="col-lg-8">

                <!-- Статия -->
                <article class="card mb-4">
                    <div class="card-body">
                        <div class="text-muted small mb-2">
                            <i class="bi bi-calendar3 me-1"></i>28 февруари 2026
                            <span class="mx-2">|</span>
                            <i class="bi bi-person me-1"></i>Иван Петров
                        </div>
                        <h2 class="card-title">5 песни, които всеки китарист трябва да знае</h2>
                        <p class="card-text">
                            Когато започваш да учиш китара, изборът на правилните песни е от съществено значение.
                            Ето пет класически парчета, които ще ти помогнат да развиеш основните си умения.
                        </p>
                        <a href="#" class="btn btn-primary">
                            Прочети цялата статия <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </article>

                <!-- Още статии -->
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <span class="badge bg-primary mb-2">За начинаещи</span>
                                <h5 class="card-title">Как да избереш първата си китара</h5>
                                <p class="card-text">Акустична или електрическа? Пълен размер или 3/4?</p>
                                <a href="#" class="btn btn-outline-primary btn-sm">Прочети</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <span class="badge bg-success mb-2">Техники</span>
                                <h5 class="card-title">Основи на fingerpicking</h5>
                                <p class="card-text">Стъпка по стъпка ръководство за fingerpicking.</p>
                                <a href="#" class="btn btn-outline-primary btn-sm">Прочети</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                @include('partials.sidebar')
            </div>
            
        </div>
    </main>

@endsection