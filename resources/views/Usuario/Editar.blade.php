<?php 
use Illuminate\Support\Facades\DB;
$cotizaciones = DB::select('SELECT C.id,C.Folio,C.Cli_Nom,C.Cli_Email,C.Cli_Direccion,C.Aut_Marca,C.Aut_Modelo,C.Aut_Azo,C.Precio,C.Fecha_Creacion,TR.id_Dep,TR.id_Cot,SUM(TR.Cantidad) AS Cantidad
                        FROM cotizaciones As C 
                        LEFT JOIN rel_cot_deps as TR ON C.id = TR.id_Cot
                        WHERE C.id = "'.$id.'"
                        GROUP BY C.id,C.Folio,C.Cli_Nom,C.Cli_Email,C.Cli_Direccion,C.Aut_Marca,C.Aut_Modelo,C.Aut_Azo,C.Precio,C.Fecha_Creacion,TR.id_Dep,TR.id_Cot
                        ORDER BY C.Fecha_Creacion
                        LIMIT 0,1;');
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
                        <h1 class="text-center">COTIZACIONES</h1>
                    </div>
                    <div class="col-md-8 offset-md-2 mb-3">
                        @foreach($cotizaciones as $cot)
                        <form class="row" method="post" action="{{ url('/Usuario/Update/'.$id)}}">
                            {!! csrf_field() !!}
                            <div class="form-group col-12">
                                <label>FOLIO</label>
                                <input type="text" class="form-control" name="DatCot01" value="{{ $cot->Folio }}" autocomplete="off" required>
                            </div>
                            <div class="form-group col-12 row">
                                <div class="col-12">
                                    <label>INFORMACION DEL CLIENTE</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="DatCot02" value="{{ $cot->Cli_Nom }}" placeholder="NOMBRE" autocomplete="off" required>
                                </div>
                                <div class="col-6">
                                    <input type="email" class="form-control" name="DatCot03" value="{{ $cot->Cli_Email }}" placeholder="EMAIL" autocomplete="off" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="DatCot04" value="{{ $cot->Cli_Direccion }}" placeholder="DIRECCIÓN" autocomplete="off" required>
                                </div>                                
                            </div>
                            <div class="form-group col-12 row">
                                <div class="col-12">
                                    <label>AUTO</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" name="DatCot05" value="{{ $cot->Aut_Marca }}" placeholder="MARCA" autocomplete="off" required>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" name="DatCot06" value="{{ $cot->Aut_Modelo }}" placeholder="MODELO" autocomplete="off" required>
                                </div>
                                <div class="col-4">
                                    <input type="number" class="form-control" name="DatCot07" value="{{ $cot->Aut_Azo }}" placeholder="AÑO" autocomplete="off" required>
                                </div>                                
                            </div>
                            <div class="form-group col-12">
                                <label>PRECIO</label>
                                <input type="number" class="form-control" name="DatCot08" value="{{ $cot->Precio }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary col-4 offset-8">EDITAR</button>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
