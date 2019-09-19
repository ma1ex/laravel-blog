# Laravel Blog

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="200"></p>

## About

Небольшой блог на фреймворке Laravel

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## Порядок развертывания Laravel для последующей разработки 
_***(for Laravel 6.0)***_

### 1. Установка интерпретатора PHP

Сначала необходимо установить, собственно, сам [PHP](https://www.php.net/downloads.php). 
Лучше всего устанавливать крайнюю версию, во-первых, потому, что он будет быстрее работать и лишен некоторых ошибок прошлого, а во-вторых, Laravel старается быть всегда в тренде и на пульсе и использует в своем фреймворке только новые технологии. Итак, скачиваем и устанавливаем:


Для упрощения дальнейшей разработки, рекомендуется прописать PHP в переменную окружения PATH, чтобы в консоле вызывать просто

```Bash
$ php <commands>
```

без указания полного пути.

### 2. Установка Composer - менеджер пакетов и зависимостей для PHP

В консоле (командной строке) последовательно вводим:

```Bash
$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
$ php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
$ php composer-setup.php
$ php -r "unlink('composer-setup.php');"
```

После этого в папке, из которой осуществлялся вызов команд, появится файл composer.phar. В дальнейшем, этот файл копируется в папку с будущим проектом и вызов осуществляется с указанием расширения:

```Bash
$ php composer.phar <commands>
``` 

### 3. Установка Laravel

Традиционно Laravel устанавливается (и официально рекомендуется, т.к. таким образом генерируется уникальный ключ) с помощью Composer`а следующими двумя командами на выбор:

```Bash
$ php composer.phar global require laravel/installer 
```

Такой вариант установит фреймворк глобально.

А такой вариант:

```Bash
$ php composer.phar create-project --prefer-dist laravel/laravel blog.local
```

установит фреймворк локально в папку blog.local.

Если проект был клонирован из репозитория, то можно вручную сгенерировать ключ командой:

```
$ php artisan key:generate
```

---
## _Необязательные пункты_

### 3.1. Настройка локального хоста на XAMMP

В новой папке blog.local создать папку logs, в ней будут логи сервера.
Далее, в файле `httpd-vhosts.conf` прописать:

```
<virtualhost *:80>
    ServerAdmin admin@blog.local
    DocumentRoot "C:/xampp/htdocs/blog.local/public"
    ServerName blog.local
    ServerAlias www.blog.local
    ErrorLog "C:/xampp/htdocs/blog.local/logs/error.log"
    CustomLog "C:/xampp/htdocs/blog.local/logs/access.log" combined
    <directory  "C:/xampp/htdocs/blog.local/public">
    Require all granted
  </directory>
</virtualhost>
```

Затем в файле hosts прописать локальный адрес:

```
127.0.0.1 blog.local
127.0.0.1 www.blog.local
```

Теперь можно запустить проект и убедиться, что все установилось и работает:

```Bash
$ php artisan serve 
```

эта команда аналог встроенной php-шной этой:

```Bash
$ cd ~/blog.local
$ php -S localhost:8000 -t public/
```

запустит локальный девелоперский сервер на 8000-м порту.
В дальнейшем команда `artisan` будет применяться в процессе разработки.

### 3.2. Структура и внутренности Laravel

Основные определния компонентов системы:

- Middleware - слой хелперов или лучше хуков, который срабатывает после роута и выполняет некоторые промежуточные действия, например, проверку авторизации пользователя, валидацию данных и т.п. перед тем, как управление перейдет контроллеру.

*** Структура и описание директорий фреймворка

```
-[app]    - само приложение
    -[Console] -
    -[Exceptions] -
    -[Http] - 
         -[Controllers] - Контроллеры
         -[Middleware] -  Хуки
    -[Providers] - Сервис-провайдеры. По сути, с них начинается работа приложения, они загружают роуты и т.д.
    - User.php - Модели

-[config] - Конфиги приложения и фреймворка в целом
-[database] - генераторы и миграции для БД
    -[factories] - собственно, генераторы данных (реальных или фейковых для тестирования)
    -[migrations] - файлы объектов сущностей для представления генерации реляционных таблиц
    -[seeds] - 

-[public] - именно эта папка должна быть доступна из вэба, это точка входа в приложение
-[resources] - все внешние ресурсы для предварительной обработки, если надо, компиляции - css (scss), JS и т.п.
    -[views] - шаблоны приложения
-[routes] - маршруты приложения
    - web.php - настройка маршрутов приложения
```
---

### 4. Настройка PhpStorm и его дополнений

***1.*** Для успешных миграций в БД необходимо изменить настройки кодировки в файле `app/Providers/AppServiceProvider.php`:

```Php
use Illuminate\Support\Facades\Schema;

public function boot()
{
    Schema::defaultStringLength(191);
}
```

А при создании новой базы данных используйте кодировку `utf8mb4_unicode_ci`.

после этого выполняем:

```Bash
$ php artisan migrate
```

***2.*** Установка плагина Laravel plugin

- В PhpStorm'е зайти "File -> Settings... -> Plugins -> Marketplace" и в строке поиска поискать `Laravel plugin`, а затем установить его. Далее там же в настройках идете `"Languages & Frameworks -> PHP -> Laravel"` и активируете плагин, установив галочку `"Enable plugin for this project"`.

- Установка "Laravel IDE Heplper" для корректрной работы автодополнений фасадов. Идем на сайт https://github.com/barryvdh/laravel-ide-helper и через композер устанавливаем дополнительный пакет для проекта в секцию DEV:

```Bash
$ php composer.phar require --dev barryvdh/laravel-ide-helper
```

После установки необходимо запустить генерацию классов-помощников командой:

```Bash
$ php artisan ide-helper:generate
$ php artisan ide-helper:meta
```

а в дальнейшем, чтобы не запускать эту команду каждый раз при установки новых пакетов для проекта, в файл `composer.json` необходимо записать команды автозапуска генерации:

```JavaScript
"scripts":{
    "post-update-cmd": [
        "Illuminate\\Foundation\\ComposerScripts::postUpdate",
        "@php artisan ide-helper:generate",
        "@php artisan ide-helper:meta"
    ]
},
```

Далее, для корректного распознавания fluent интерфейсов нам нужно скопировать конфиг пакета из папки vendor в папку с пользовательскими настройками. Сделать это можно двумя способами, но рекомендуется использовать команду:

```Bash
$ php artisan vendor:publish --provider="Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider" --tag=config
```

после этого в папке /config появится файл ide-helper.php. И далее в нем меняем с false а true:

```Php
'include_fluent' => true,
```

и заново запускаем перегенерацию:

```Bash
$ php artisan ide-helper:generate
$ php artisan ide-helper:meta
```

***3.*** Установка панели отладки Laravel

Сайт автора: https://github.com/barryvdh/laravel-debugbar

В композере выполняем следующую команду:

```Bash
$ php composer.phar require barryvdh/laravel-debugbar --dev
```

после этого внизу страниц работающего фреймворка появится панель отладки.
Если этого не произошло, следует изменить строку `APP_DEBUG=true` в файле конфигурации .env (в *nix системах этот файл может быть невидим):

```
APP_DEBUG=true
```

Отключение происходит изменением этой опции с true а false.

***4.*** Автоматизация рутинных команд с помощью Composer

В секцию `scripts` можно дописывать свои команды, чтобы как-то автоматизировать и облечить себе разработку.
Запускаются команды так:

```Bash
$ php composer.phar run <commands>
```

Учитывая, что для разработки используется встроенный в PHP сервер (https://www.php.net/manual/ru/features.commandline.webserver.php), коего для этих целей хватает, то, чтобы не заморачиваться установкой и настройкой сборок WampServer, XAMPP, MAMP и им подобным, можно обойтись установкой только непосредственно самого PHP и необходимой СУБД, а доступ к базам данных получать через такой замечательный инструмент, как компактный однофайловый Adminer https://www.adminer.org/en/ , то можно создать отдельную git-игнорируемую директорию и скопировать этот файл туда, например, учитывая всё вышесказанное: `blog.local/tools/db/adminer.php`, а в секции `scripts` файла `composer.json` прописать:

```JavaScript
"scripts": {
    "db-manager": [
        "Composer\\Config::disableProcessTimeout",
        "@php -S localhost:8001 -r tools/db/adminer.php"
    ]
}
```

или, переименовав `adminer.php` в `index.php`, можно указать так:

```JavaScript
"scripts": {
    "db-manager": [
        "Composer\\Config::disableProcessTimeout",
        "@php -S localhost:8001 -t tools/db/"
    ]
}
```

Запускать можно из терминала PhpStorm`а из корневой папки проекта:

```Bash
$ php composer.phar run db-manager
```

или еще короче, если composer установлен глобально:

```Bash
$ composer run db-manager
```

Доступен будет по адресу `http://localhost:8001/tools/db/adminer.php` для первого варианта или `http://localhost:8001/tools/db/` для второго.

Команда `Composer\\Config::disableProcessTimeout` - это, чтобы преодолеть стандартное ограничение по времени выполнения скриптов из этой секции в 300 секунд. Данная команда отключает таймер для этого скрипта (docs - https://getcomposer.org/doc/articles/scripts.md#running-scripts-manually).

При желании таким же образом можно скачать и установить phpMyAdmin, только флаг `-t` надо убрать, создать файл `router.php`, в котором указать правила обработки неподдерживаемых MIME-типов для правильной обработки сервером и скопировать в директорию с phpMyAdmin:

```Php
<?php
    // router.php
    $path = pathinfo($_SERVER["SCRIPT_FILENAME"]);
    if ($path["extension"] == "el") {
        header("Content-Type: text/x-script.elisp");
        readfile($_SERVER["SCRIPT_FILENAME"]);
    }
    else {
        return FALSE;
    }
?>
```

Команда запуска будет такой:

```Bash
$ php -S localhost:8002 tools/db/phpMyAdmin/router.php
```

Однако, это приложение тяжело для этого сервера и будет несчадно тормозить... Лучше использовать вариант со встроенным.

### 5. Начало разработки

***1.*** Генерация механизма аутентификации

С версии 6.0 порядок создания механизма аутентификации изменился с ранее простого `php artisan make:auth` на _(выполнить последовательно)_:

```Bash
$ composer.phar require laravel/ui
$ php artisan ui vue --auth
```

затем

```Bash
$ npm install
$ npm run dev
```

А все потому, что интерфейс основан на Vue.js и для отрисовки страниц необходимо скомпилировать билд. Только после этого аутентификация штатно заработает. 