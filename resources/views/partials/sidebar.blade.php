<aside>
    <!-- Категории -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="border-bottom text-muted pb-2 mb-3">
                <i class="bi bi-folder me-2"></i>Категории
            </h5>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    За начинаещи
                    <span class="badge bg-primary rounded-pill">12</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Техники
                    <span class="badge bg-primary rounded-pill">8</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Поддръжка
                    <span class="badge bg-primary rounded-pill">5</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Рецензии
                    <span class="badge bg-primary rounded-pill">15</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Абонамент -->
    <div class="card">
        <div class="card-body">
            <h5 class="border-bottom text-muted pb-2 mb-3">
                <i class="bi bi-envelope me-2"></i>Абонирай се
            </h5>
            <p class="text-muted small">Получавай нови статии директно в пощата си.</p>
            <form >
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Твоят имейл">
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    Абонирай се <i class="bi bi-send ms-1"></i>
                </button>
            </form>
        </div>
    </div>
</aside>