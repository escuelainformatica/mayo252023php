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

## agregar un componente.

En artisan, cree un componente nuevo con

```
php artisan make:component NombrComponente
```

Esto va a crear una clase y una vista.

### editar la clase del componente

en la carpeta /app/views/components se guarda las clases de los componentes

```php
class Alert extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        
        return view('components.alert');
    }
}
```
> La vista es solo una vista regular, no tiene ningun comportamiento especial.

### llamar a un componente.

Para llamara a un componente, hay que registrarlo.
Se podria registrar en la funcion boot() de algun proveedor cargado (app/providers) o se llama manualmente antes de usarlo

```php
    Blade::component('nombrecomp', Alert::class);
```

Una vez registrado, en el template se ocupa de la siguiente manera


```html
    <x-nombrecomp />
```

### pasar valores a un componente.
Se pueden pasar valores fijos o variables al componente.

```html
    <x-nombrecomp fijo="hola" :variable="$valor" />
```

Para capturar los valores en la clase, se usa lo siguiente

```php
class Alert extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $fijo,public string $variable)
    {
        //
    }
    public function render(): View|Closure|string
    {
        // return view('components.alert',['fijo'=>$fijo,'variable'=>$variable]); no es necesario
        return view('components.alert');
    }
}
```

> Cuando llamo a la vista view('nombrevista'), no necesito pasar manualmente esos valores. Por defecto se pasan.