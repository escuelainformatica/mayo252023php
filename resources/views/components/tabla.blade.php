<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            @foreach ($campos as $campo)
                <th>{{$campo}}</th>    
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($valores as $valor)
            <tr>
                @foreach ($campos as $campo)
                    <td>{{$valor[$campo]}}</td>    
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>