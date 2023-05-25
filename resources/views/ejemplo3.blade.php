@extends("maestra")
@section("contenido")
<h1>usando include</h1>
<table>
    <thead>
        <tr>
            <th>nombre</th>
            <th>id</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($paises as $pais)
        @include("fila",['pais'=>$pais])
        @endforeach
    </tbody>
</table>
<h1>usando componente</h1>

<table>
    <thead>
        <tr>
            <th>nombre</th>
            <th>id</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($paises as $pais)
        <x-comp-fila :pais="$pais" />
        @endforeach
    </tbody>
</table>

<h1>usando componente v2</h1>
<x-tabla  :valores="$paises" />


<x-tabla  :valores="$productos" />

@endsection
