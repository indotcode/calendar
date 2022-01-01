# Календарь для Laravel

![Скриншот календаря](https://raw.githubusercontent.com/indotcode/calendar/master/screenshots/screenshot.png "Орк")

## Установка Composer

```text
composer require indotcode/calendar
```

## Подключения

**Файл:** config/app.php
```php
Indotcode\Calendar\CalendarServiceProvider::class;
```

## Импорт ресурсов
```text
php artisan vendor:publish --provider="Indotcode\Calendar\CalendarServiceProvider"
```

## Вызов в шаблоне

### Календарь

```blade
{{\Indotcode\Calendar\View::get($config = [])}}
```

### Массив конфигурации календаря

| Имя                          | Тип     | Описание                              | Default              | Допустимые значения |
|:-----------------------------|:--------|:--------------------------------------|:---------------------|:--------------------|
| visible_current_date         | Boolean | Показывать текущюю дату               | true                 | true, false         |
| year                         | String  | Начальный год                         | Текущий год          | от 1990 до 2100     |
| months                       | Integer | Начальный месяц                       | Текущий месяц        | 1 - 12              |
| display_navigation           | Boolean | Показывать стрелки навигации          | true                 | true, false         |

### Стили

```blade
{{\Indotcode\Calendar\View::css()}}

или

{{\Indotcode\Calendar\View::css(
    ['font_family' => 'Roboto'])
}}
```
*Принимает массив параметров.*

**Параметры:**

| Имя         | Тип    | Описание        | Пример   |
|:------------|:-------|:----------------|:---------|
| font_family | string | Название шрифта | 'Roboto' |


### Скрипты

```blade
{{\Indotcode\Calendar\View::js()}}
```
