## Календарь для Laravel


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
{{\Indotcode\Calendar\Calendar::view()}}
```

#### Стили

```blade
{{\Indotcode\Calendar\Calendar::css()}}

and

{{\Indotcode\Calendar\Calendar::css(
    ['font_family' => 'Roboto'])
}}
```
*Принимает массив параметров.*

**Параметры:**

- font_family (string) - Название шрифта. Пример: 'Roboto'


#### Скрипты

```blade
{{\Indotcode\Calendar\Calendar::js()}}
```
