## Календарь для Laravel

![Скриншот календаря](https://raw.githubusercontent.com/indotcode/calendar/master/screenshots/screenshot.png "Орк")

### Установка Composer

```text
composer require indotcode/calendar
```

### Подключения

**Файл:** config/app.php
```php
Indotcode\Calendar\CalendarServiceProvider::class;
```

### Импорт ресурсов
```text
php artisan vendor:publish --provider="Indotcode\Calendar\CalendarServiceProvider"
```

### Вызов в шаблоне

#### Календарь

```blade
{{\Indotcode\Calendar\View::get()}}

или

{!! $calendar !!} // Обработка через Controller
```

#### Стили

```blade
{{\Indotcode\Calendar\View::css()}}

или

{{\Indotcode\Calendar\View::css(
    ['font_family' => 'Roboto'])
}}
```
*Принимает массив параметров.*

**Параметры:**

| Имя | Тип | Описание | Пример
|:----------------|:---------|:----------------|:----|
| font_family | string | Название шрифта | 'Roboto' |


#### Скрипты

```blade
{{\Indotcode\Calendar\Calendar::js()}}
```
