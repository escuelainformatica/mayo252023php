# Ocupar dos base de datos

Para ocupar dos bases de datos se necesita editar la configuracion de /config/database.php y agregar otra conexion.

```php
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],
        'sqlite2' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE_2', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],
```

> Si se necesita conectar a base de datos distintas, no es necesario crear una nueva conexion.


## en la variable del entorno
Agregar las variables que se quieren usar. En este caso DB_DATABASE_2 es la siguiente variable del entorno:

```
DB_CONNECTION_2=sqlite
DB_DATABASE_2=./database/base2.sqlite
```


## En los modelos.
Para indicar que conexion usa cada modelo, se puede indicar con:

```php
class Post extends Model
{
    use HasFactory;
    protected $connection = 'sqlite'; // el nombre del modelo.
}
```
## Sin usar los modelos
Para determinar la conexion a usar (Database), se puede usar:

```php
Schema::connection("sqlite")->...
DB::connection('sqlite')->...
```

# Blade (templates)

## incluir un template

```php
@include("nombretemplate")
```

## extender un template

maestro.blade.php
```html
...
    @section("contenido")
    @show

    @yield("otrocontenido","valor defecto")
...
```

* section y yield son similares, salvo que yield estan mas enfocados en mostrar un contenido corto.

```html
@extends("maestro")
    @section("contenido")
    <h1>el contenido</h1>
    @endsection

    @section("otrocontenido","esto va en el yield")
```