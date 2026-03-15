# MVC Controllers Exercise

Laravel 12 проект за упражнение по MVC контролери.

## Изисквания

### Задължителни
- PHP 8.2 или по-нова версия
- Composer

### Опционални
- Node.js и npm (за компилиране на frontend assets)

## Инсталация

1. Клонирайте репозиторито:
```bash
git clone https://github.com/ivanOgnyanov/mvc-controllers-exercise.git
cd mvc-controllers-exercise
```

2. Инсталирайте PHP зависимостите:
```bash
composer install
```

3. Копирайте конфигурационния файл:
```bash
cp .env.example .env
```

4. Генерирайте application key:
```bash
php artisan key:generate
```

5. Създайте базата данни и изпълнете миграциите:
```bash
php artisan migrate
```

6. **(Опционално)** Ако имате Node.js, инсталирайте frontend зависимостите:
```bash
npm install
npm run build
```

## Стартиране

Стартирайте локалния сървър:
```bash
php artisan serve
```

Приложението ще бъде достъпно на: http://localhost:8000
