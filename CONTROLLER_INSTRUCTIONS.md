# Ръководство: Контролери и обработка на форми в Laravel

---

## Съдържание
1. [Named Routes и активни линкове](#1-named-routes-и-активни-линкове)
2. [ЗАДАЧА: Named route за статиите](#2-задача-named-route-за-статиите)
3. [Създаване на контролер](#3-създаване-на-контролер)
4. [Route за обработка на форма](#4-route-за-обработка-на-форма)
5. [Валидация на данни](#5-валидация-на-данни)
6. [Съобщения за грешки на български](#6-съобщения-за-грешки-на-български)
7. [Форма за регистрация](#7-форма-за-регистрация)
8. [ЗАДАЧА: Валидация на регистрацията](#8-задача-валидация-на-регистрацията)

---

## 1. Named Routes и активни линкове

**Цел:** Даваме имена на routes и показваме кой линк е активен в менюто.

### 1.1 Какво е Named Route?

Named route е route с име, което позволява лесно генериране на URL адреси в цялото приложение.

### 1.2 Добавете име на route-а за началната страница

Редактирайте `routes/web.php`:

```php
Route::get('/', function () {
    return view('pages.home');
})->name('home');
```

### 1.3 Променете navbar да показва активния линк

Редактирайте `resources/views/partials/navbar.blade.php`:

**Преди:**
```html
<a class="nav-link active" href="{{ url('/') }}">
    <i class="bi bi-house me-1"></i>Начало
</a>
```

**След:**
```html
<a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
    <i class="bi bi-house me-1"></i>Начало
</a>
```

### Какво научихме:

| Функция | Описание |
|---------|----------|
| `->name('home')` | Дава име на route |
| `route('home')` | Генерира URL по име на route |
| `Route::currentRouteName()` | Връща името на текущия route |
| `{{ условие ? 'да' : 'не' }}` | Тернарен оператор в Blade |

### Проверка в браузър

1. Отворете: **http://127.0.0.1:8000**
2. Отворете Developer Tools (F12) → Elements
3. Намерете линка "Начало" - трябва да има клас `active`
4. Кликнете на "Статии" - "Начало" вече НЕ трябва да има `active`

---

## 2. ЗАДАЧА: Named route за статиите

**Вашата задача:** Направете същото за страницата "Статии".

### Подсказки:
1. В `routes/web.php` добавете `->name('articles.index')` към route-а за `/articles`
2. В `navbar.blade.php` променете линка за "Статии" по същия начин като "Начало"

### Очакван резултат:
- Когато сте на `/articles`, линкът "Статии" има клас `active`
- Когато сте на `/`, линкът "Начало" има клас `active`

---

## 3. Създаване на контролер

**Цел:** Създаваме контролер за обработка на абонаментите.

### 3.1 Какво е контролер?

Контролерът е клас, който съдържа логиката за обработка на заявки. Вместо да пишем логика директно в `routes/web.php`, я изнасяме в отделен файл.

### 3.2 Създайте контролер с Artisan

В терминала изпълнете:

```bash
php artisan make:controller SubscriptionController
```

**Резултат:** Създава се файл `app/Http/Controllers/SubscriptionController.php`

### 3.3 Разгледайте създадения файл

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //
}
```

### Проверка

Проверете дали файлът е създаден в `app/Http/Controllers/SubscriptionController.php`

---

## 4. Route за обработка на форма

**Цел:** Свързваме формата за абонамент с контролера.

### 4.1 Добавете метод в контролера

Редактирайте `app/Http/Controllers/SubscriptionController.php`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        dd($request->all());
    }
}
```

**Какво е `dd()`?** - "Dump and Die" - показва данните и спира изпълнението. Използва се за дебъгване.

### 4.2 Добавете route в web.php

Редактирайте `routes/web.php`:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;

// ... съществуващи routes ...

Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');
```

**Забележете:**
- `Route::post()` - приема само POST заявки (за форми)
- `[SubscriptionController::class, 'store']` - извиква метода `store` от контролера

### 4.3 Обновете формата в sidebar

Редактирайте `resources/views/partials/sidebar.blade.php`:

Намерете формата за абонамент и добавете `action` и `name` атрибути:

```html
<form action="{{ route('subscribe') }}" method="POST">
    @csrf
    <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Твоят имейл">
    </div>
    <button type="submit" class="btn btn-primary w-100">
        Абонирай се <i class="bi bi-send ms-1"></i>
    </button>
</form>
```

**Важно:**
- `action="{{ route('subscribe') }}"` - накъде да се изпрати формата
- `method="POST"` - метод на изпращане
- `name="email"` - име на полето (така го получаваме в контролера)

### Проверка в браузър

1. Отворете началната страница
2. Въведете имейл в полето за абонамент
3. Натиснете "Абонирай се"
4. **Очакван резултат:** Виждате `dd()` с данните:

```
array:2 [
  "_token" => "abc123..."
  "email" => "test@example.com"
]
```

---

## 5. Валидация на данни

**Цел:** Проверяваме дали въведеният имейл е валиден.

### 5.1 Добавете валидация в контролера

Редактирайте `app/Http/Controllers/SubscriptionController.php`:

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email'
    ]);

    return back()->with('success', 'Успешно се абонирахте!');
}
```

**Какво прави `validate()`:**
- `required` - полето е задължително
- `email` - проверява дали е валиден имейл формат
- При грешка - автоматично връща потребителя назад с грешките
- При успех - продължава изпълнението

**Пълен списък с правила за валидация:**
https://laravel.com/docs/12.x/validation#available-validation-rules

### 5.2 Покажете грешките във формата

Редактирайте формата в `resources/views/partials/sidebar.blade.php`:

```html
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('subscribe') }}" method="POST">
    @csrf
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="mb-3">
        <input type="email" name="email"
               class="form-control @error('email') is-invalid @enderror"
               placeholder="Твоят имейл"
               value="{{ old('email') }}">
    </div>
    <button type="submit" class="btn btn-primary w-100">
        Абонирай се <i class="bi bi-send ms-1"></i>
    </button>
</form>
```

**Нови директиви:**
| Директива | Описание |
|-----------|----------|
| `@error('email')` | Проверява дали има грешка за полето 'email' |
| `{{ $message }}` | Показва съобщението за грешка |
| `@enderror` | Край на @error блока |
| `{{ old('email') }}` | Връща предишната стойност на полето |
| `session('success')` | Чете flash съобщение от сесията |

### Проверка в браузър

**Тест 1: Празна форма**
1. Оставете полето празно
2. Натиснете "Абонирай се"
3. **Очакван резултат:** Съобщение "The email field is required."

**Тест 2: Невалиден имейл**
1. Въведете "test" (без @)
2. Натиснете "Абонирай се"
3. **Очакван резултат:** Съобщение "The email field must be a valid email address."

**Тест 3: Валиден имейл**
1. Въведете "test@example.com"
2. Натиснете "Абонирай се"
3. **Очакван резултат:** Зелено съобщение "Успешно се абонирахте!"

---

## 6. Съобщения за грешки на български

**Цел:** Превеждаме съобщенията за валидация на български език.

Забелязахте ли, че съобщенията за грешка са на английски? Laravel има пакет за локализация, който поддържа много езици, включително български.

### 6.1 Инсталирайте пакета за езици

В терминала изпълнете:

```bash
composer require laravel-lang/common --dev
```

### 6.2 Добавете българския език

```bash
php artisan lang:add bg
```

**Резултат:** Създава се папка `lang/bg/` с преведени файлове.

### 6.3 Конфигурирайте приложението

Редактирайте `.env` файла:

```
APP_LOCALE=bg
APP_FALLBACK_LOCALE=en
```

### Проверка в браузър

1. Рестартирайте сървъра (`php artisan serve`)
2. Оставете полето за имейл празно
3. Натиснете "Абонирай се"
4. **Очакван резултат:** Съобщение на български: "Полето email е задължително."

**Преди:** "The email field is required."
**След:** "Полето email е задължително."

---

## 7. Форма за регистрация

**Цел:** Създаваме страница за регистрация с форма.

### 7.1 Създайте UserController

```bash
php artisan make:controller UserController
```

### 7.2 Добавете методи в контролера

Редактирайте `app/Http/Controllers/UserController.php`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('pages.register');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
```

**Конвенция:**
- `create()` - показва формата (GET заявка)
- `store()` - обработва формата (POST заявка)

### 7.3 Добавете routes

В `routes/web.php`:

```php
use App\Http\Controllers\UserController;

// ... други routes ...

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
```

### 7.4 Създайте view за регистрация

Създайте `resources/views/pages/register.blade.php`:

```blade
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
                            <input type="text" name="name" id="name" class="form-control"
                                   placeholder="Въведи името си">
                        </div>

                        <!-- Имейл -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Имейл</label>
                            <input type="email" name="email" id="email" class="form-control"
                                   placeholder="Въведи имейл адрес">
                        </div>

                        <!-- Парола -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Парола</label>
                            <input type="password" name="password" id="password" class="form-control"
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
```

### Проверка в браузър

1. Отворете: **http://127.0.0.1:8000/users/create**
2. Попълнете формата
3. Натиснете "Регистрирай се"
4. **Очакван резултат:** Виждате `dd()` с всички данни от формата

---

## 8. ЗАДАЧА: Валидация на регистрацията

**Вашата задача:** Добавете валидация за регистрационната форма.

### Изисквания:
1. Всички полета да са задължителни (`required`)
2. Имейлът да е валиден (`email`)
3. Паролите да съвпадат

### Подсказка за паролите (https://laravel.com/docs/12.x/validation#available-validation-rules):
Laravel има специално правило `confirmed`, което автоматично проверява дали `password` съвпада с `password_confirmation`.

```php
'password' => 'required|confirmed'
```

### Допълнителни изисквания (по желание):
- Името да е поне 2 символа (`min:2`)
- Паролата да е поне 6 символа (`min:6`)

### Добавете показване на грешки във формата

Добавете `@error` блокове за всяко поле, подобно на формата за абонамент.

### Очакван резултат:
- При празни полета - съобщения за грешка на български
- При различни пароли - съобщение "Полето password не съвпада."
- При успешна валидация - съобщение за успех

---

## Обобщение

| Концепция | Пример |
|-----------|--------|
| Named Route | `->name('home')` |
| Генериране на URL | `route('home')` |
| Текущ route | `Route::currentRouteName()` |
| Създаване на контролер | `php artisan make:controller Name` |
| POST Route | `Route::post('/url', [Controller::class, 'method'])` |
| Валидация | `$request->validate(['field' => 'rules'])` |
| Показване на грешки | `@error('field') ... @enderror` |
| Flash съобщение | `return back()->with('success', 'Message')` |
| Предишна стойност | `{{ old('field') }}` |
| Локализация | `composer require laravel-lang/common --dev` |
| Добавяне на език | `php artisan lang:add bg` |

---

*Следващи стъпки: Свързване с база данни и запис на потребители*
