<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="bi bi-music-note-beamed me-2"></i>Китари
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/') }}">
                        <i class="bi bi-house me-1"></i>Начало
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/articles') }}">
                        <i class="bi bi-newspaper me-1"></i>Статии
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-mortarboard me-1"></i>Уроци
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-info-circle me-1"></i>За нас
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <!-- Dark Mode Toggle -->
                <button class="theme-toggle" id="theme-toggle" aria-label="Превключи тема">
                    🌙
                </button>
                <a href="#" class="btn btn-outline-primary btn-sm">Вход</a>
                <a href="#" class="btn btn-primary btn-sm">Регистрация</a>
            </div>
        </div>
    </div>
</nav>