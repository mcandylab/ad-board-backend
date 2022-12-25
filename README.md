### Используемые пакеты

- **spatie/laravel-sluggable** - для автоматической генерации slug (https://github.com/spatie/laravel-sluggable)
- **spatie/laravel-medialibrary** - для работы с медиа данными (https://spatie.be/docs/laravel-medialibrary/v10/introduction)
- **Laravel Sanctum** - для аутентификации через API

---

### Запуск проекта

Установка зависимостей:
```
composer i
```

Создание .env файла:
```
cp .env.example .env
```
```
php artisan key:generate
```

Необходимо прописать в `.env` подключение к базе данных

Запуск миграции:
```
php artisan migrate
```

Создание символической ссылки для storage:
```
php artisan storage:link
```

Запуск проекта:
```
php artisan serve
```


