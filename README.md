### Используемые пакеты

- **spatie/laravel-sluggable** - для автоматической генерации slug (https://github.com/spatie/laravel-sluggable)
- **spatie/laravel-medialibrary** - для работы с медиа данными (https://spatie.be/docs/laravel-medialibrary/v10/introduction)
- **Laravel Sanctum** - для аутентификации через API

---

### Запуск проекта

Установка зависимостей:
```shell
composer i
```

Создание .env файла:
```shell
cp .env.example .env
```
```shell
php artisan key:generate
```

Необходимо прописать в `.env` подключение к базе данных

Запуск миграции:
```shell
php artisan migrate
```

Создание символической ссылки для storage:
```shell
php artisan storage:link
```

Запуск проекта:
```shell
php artisan serve
```


