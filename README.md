# Weather app

Тестовое задание.

Обзор задачи:
Разработать простое приложение для прогноза погоды, которое позволит пользователям искать города и просматривать текущие
погодные условия для выбранного местоположения.
Требования:

1. Поиск города:
   ○ Пользователи должны иметь возможность искать город по имени и видеть текущую температуру, погодные условия и
   скорость ветра для данного местоположения.
2. Единицы измерения:
   ○ Приложение должно позволять переключаться между единицами
   измерения Цельсия и Фаренгейта. 4. Интеграция с API:
   ○ Используйте публичный API погоды (например, OpenWeatherMap) для получения текущих погодных данных.
3. Обработка ошибок:
   ○ Отображайте соответствующие сообщения об ошибках, если API
   возвращает ошибку или запрос пользователя не совпадает с известными
   местоположениями.
4. Функция "недавние поиски":
   ○ Включите функцию "недавние поиски", которая отображает список из последних пяти городов, которые пользователь
   искал.
5. Обработка ошибок и валидация:
   ○ Используйте подходящую обработку ошибок и валидацию, чтобы
   обеспечить надежность и удобство использования приложения.

# Стек

* Laravel 11;
* Laravel Sail;
* Laravel Pint;
* Pest;
* Larastan;
* PostgreSQL;
* PgBouncer;

# API

Каждый запрос должен принимать `Header`, для получения данных в формате json:

```
Accept — application/json
```

Запрос может принимать `Accept-Language` для смены языка.

Доступные значения:

1. en (По-умолчанию)
2. ru

Язык влияет на ответы стороннего `api`.

## Get weather

```
GET api/v1/weather
```

Возвращает информацию о погоде.

Принимает:

* city — обязательно, название `города`||`широта/долгота`||`ip`
* temp — необязательно, возможные значения: `celsius`, `fahrenheit`. По-умолчанию `celsius`.

json:

```json
{
    "data": {
        "city": "Рим",
        "country": "Италия",
        "condition": "Ясно",
        "cloud": 0,
        "temp_fahrenheit": 66.4,
        "feels_like_fahrenheit": 66.4,
        "wind_mph": 2.5,
        "wind_kph": 4,
        "gust_mph": 4.3,
        "gust_kph": 6.9
    }
}
```

## Get history

```
GET api/v1/history
```

Возвращает историю запросов пользователя по ip.

json:

```json
{
    "data": [
        {
            "id": 14,
            "search": "Лондон",
            "created_at": "2024-10-22T20:29:23.000000Z",
            "updated_at": "2024-10-22T20:29:23.000000Z"
        },
        {
            "id": 13,
            "search": "Рим",
            "created_at": "2024-10-22T20:03:51.000000Z",
            "updated_at": "2024-10-22T20:42:55.000000Z"
        },
        {
            "id": 12,
            "search": "Екатеринбург",
            "created_at": "2024-10-22T20:03:33.000000Z",
            "updated_at": "2024-10-22T20:03:33.000000Z"
        },
        {
            "id": 11,
            "search": "Токио",
            "created_at": "2024-10-22T20:03:12.000000Z",
            "updated_at": "2024-10-22T20:03:12.000000Z"
        },
        {
            "id": 10,
            "search": "Москва",
            "created_at": "2024-10-22T20:02:39.000000Z",
            "updated_at": "2024-10-22T20:02:57.000000Z"
        }
    ]
}
```

# Установка

* Склонировать проект
* Войти в созданную папку и ввести команду в терминал:

```
docker run --rm --interactive --tty -v $(pwd):/app composer install
```

* Создать .env файл на основе `.env.example` и настроить окружение. (Указать наименование бд, пользователя, пароль и
  т.д);
* Необходимо зарегистрироваться на сайте www.weatherapi.com и получить токен. Указать его в `.env.example` `WEATHER_API_KEY=`
* Запустить докер контейнер командой:

```
sail up -d
```

* Войти внутрь контейнера:

```
docker exec -it weather-app-php-1 bash
```

* Ввести команду

```
php artisan key:generate
```

* Запустить миграции

```
php artisan migrate
```

* Выполнить команду

```
php artisan queue:work
```

* Опробовать API;

## Дополнительная информация

* В проекте использутеся фреймворк для тестирования (PEST) и написаны несколько тестов;
* Наличие фиксера стилей (Pint);
* Проверка кода (Larastan);

Все вышеперечисленное проверяется в тестах github actions
