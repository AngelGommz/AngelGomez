<?php 
use Illuminate\Support\Facades\DB;
$cotizaciones = DB::select('SELECT C.id,C.Folio,C.Cli_Nom,C.Cli_Email,C.Cli_Direccion,C.Aut_Marca,C.Aut_Modelo,C.Aut_Azo,C.Precio,C.Fecha_Creacion,TR.id_Cot,SUM(TR.Cantidad) AS Cantidad
                        FROM cotizaciones As C 
                        LEFT JOIN rel_cot_deps as TR ON C.id = TR.id_Cot
                        WHERE C.id = "'.$id.'"
                        GROUP BY C.id,C.Folio,C.Cli_Nom,C.Cli_Email,C.Cli_Direccion,C.Aut_Marca,C.Aut_Modelo,C.Aut_Azo,C.Precio,C.Fecha_Creacion,TR.id_Cot
                        ORDER BY C.Fecha_Creacion
                        LIMIT 0,1;');
$abonos = DB::select('SELECT D.id,D.Descripcion,D.Total,D.Fecha_Creacion,TR.id_Dep,TR.id_Cot,TR.Cantidad
                        FROM depositos As D 
                        LEFT JOIN rel_cot_deps as TR ON D.id = TR.id_Dep
                        WHERE TR.id_Cot = "'.$id.'"
                        ORDER BY D.Fecha_Creacion;');
$depositos = DB::select('SELECT D.id,D.Descripcion,D.Total,D.Fecha_Creacion,SUM(TR.Cantidad) AS Cantidad 
                            FROM depositos As D 
                            LEFT JOIN rel_cot_deps as TR ON D.id = TR.id_Dep
                            GROUP BY D.id,D.Descripcion,D.Total,D.Fecha_Creacion
                            ORDER BY D.Fecha_Creacion;');
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- Styles -->
        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ url('/Usuario')}}">
                            <button type="button" class="btn btn-secondary">ATRAS</button>                        
                        </a>
                    </div>
                    <div class="col-12">
                        <h1 class="text-center">ABONOS</h1>
                    </div>
                    <div class="col-md-8 offset-md-2 mb-3 row">
                        @foreach($cotizaciones as $cot)
                        <div class="col-12">
                            <h3 class="text-center">FOLIO: {{ $cot->Folio }}</h3>
                        </div>
                        <div class="col-12">
                            <h4 class="text-center" >DATOS DEL CLIENTE</h4>
                        </div>
                        <div class="col-md-4">
                            <p>Nombre: {{ $cot->Cli_Nom }}</p>
                        </div>
                        <div class="col-md-4">
                            <p>Email: {{ $cot->Cli_Email }}</p>
                        </div>
                        <div class="col-md-4">
                            <p>Dirección: {{ $cot->Cli_Direccion }}</p>
                        </div>
                        <div class="col-12">
                            <h4 class="text-center" >AUTO</h4>
                        </div>
                        <div class="col-md-4">
                            <p>Marca: {{ $cot->Aut_Marca }}</p>
                        </div>
                        <div class="col-md-4">
                            <p>Modelo: {{ $cot->Aut_Modelo }}</p>
                        </div>
                        <div class="col-md-4">
                            <p>Año: {{ $cot->Aut_Azo }}</p>
                        </div>
                        <div class="col-12">
                            <h4 class="text-center" >PRECIO: ${{ number_format($cot->Precio, 2, '.', ',') }}</h4>
                        </div>
                        <?php $Faltante = $cot->Precio - $cot->Cantidad ?>
                        @endforeach
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Pagado</th>
                                        <th scope="col">Fecha de Creación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($abonos as $abo)
                                    <tr>
                                        <td>{{$abo->Descripcion }}</td>
                                        <td>${{number_format($abo->Total, 2, '.', ',')  }}</td>
                                        <td>${{number_format($abo->Cantidad, 2, '.', ',')  }}</td>
                                        <td>{{date("d-m-Y", strtotime($abo->Fecha_Creacion)) }}</td>
                                    </tr> 
                                    @endforeach
                                    <tr>
                                        <form method="post" action="{{ url('/Usuario/InseAbo/'.$id)}}">
                                            {!! csrf_field() !!}
                                            <td colspan="2">
                                                <select class="form-control" name="DatCot01" required>
                                                    <option></option>
                                                    @foreach($depositos as $dep)Total
                                                    @if(($dep->Total - $dep->Cantidad) != 0)
                                                    <option value="{{ $dep->id }}">{{ $dep->Descripcion }}/ ${{ $dep->Total - $dep->Cantidad }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" id="DatCot02" class="form-control" name="DatCot02" placeholder="CANTIDAD" autocomplete="off" required>
                                            </td>
                                            <td><button type="submit" class="btn btn-primary">AGREGAR</button></td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <h4 class="text-center" >TOTAL: ${{ number_format($Faltante, 2, '.', ',') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
