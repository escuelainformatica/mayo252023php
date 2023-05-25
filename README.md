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
