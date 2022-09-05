# endpoint

```table
+--------+----------+-----------------------+-----------------------------+------------------------------------------------------------+------------------------------------------+
| Domain | Method   | URI                   | Name                        | Action                                                     | Middleware                               |
+--------+----------+-----------------------+-----------------------------+------------------------------------------------------------+------------------------------------------+
|        | GET|HEAD | /                     | generated::Mw6ZkZxX98fTxUyc | Closure                                                    | web                                      |
|        | POST     | api/login             | generated::YZndw1Yxmeu9G74q | App\Http\Controllers\API\AuthController@login              | api                                      |
|        | POST     | api/logout            | generated::8i1KfHlFhf6PxytE | App\Http\Controllers\API\AuthController@logout             | api                                      |
|        |          |                       |                             |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST     | api/register          | generated::Xh29jkgeJUv0HUSJ | App\Http\Controllers\API\AuthController@register           | api                                      |
|        | GET|HEAD | api/trip              | generated::8Ie5T75Wr569H9D8 | App\Http\Controllers\API\TripController@index              | api                                      |
|        |          |                       |                             |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST     | api/trip/create       | generated::Jf3V0dWs2QRJ5tfc | App\Http\Controllers\API\TripController@create             | api                                      |
|        |          |                       |                             |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | DELETE   | api/trip/delete/{id}  | generated::XziUokURxLsY7Lsb | App\Http\Controllers\API\TripController@delete             | api                                      |
|        |          |                       |                             |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD | api/trip/type_of_trip | generated::tDUqowWTFxxQHhVe | App\Http\Controllers\API\TripController@type               | api                                      |
|        |          |                       |                             |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | PUT      | api/trip/update       | generated::BsIZjX9PSW7grsvI | App\Http\Controllers\API\TripController@update             | api                                      |
|        |          |                       |                             |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD | sanctum/csrf-cookie   | generated::WVJoxx9fo5f6yl4S | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show | web                                      |
+--------+----------+-----------------------+-----------------------------+------------------------------------------------------------+------------------------------------------+
```

# test

### test prep

create new files

```cli
cp .env .env.testing

touch test.sqlite
```

define .env.testing

```env
APP_ENV=testing
DB_DATABASE=./test.sqlite
```

update tests\CreatesApplication.php

```php
public function createApplication()
{
    $app = require __DIR__.'/../bootstrap/app.php';

    $app->make(Kernel::class)->bootstrap();

    config(['database.default' => 'sqlite']);

    return $app;
}
```

seed data

```cli
php artisan db:seed
```

change env to testing

```cli
php artisan config:cache --env=testing
```

change back to local

```cli
php artisan config:cache --env=local
```

run testing by className

```cli
vendor/bin/phpunit --filter 'Tests\\Unit\\TripTest'

vendor/bin/phpunit --filter 'Tests\\Unit\\AuthTest'
```

