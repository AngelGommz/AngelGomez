<?php 
use Illuminate\Support\Facades\DB;
$depositos = DB::select('SELECT D.id,D.Descripcion,D.Total,D.Fecha_Creacion,TR.id_Dep,TR.id_Cot,SUM(TR.Cantidad) AS Cantidad 
                            FROM depositos As D 
                            LEFT JOIN rel_cot_deps as TR ON D.id = TR.id_Dep
                            WHERE D.id = "'.$id.'"
                            GROUP BY D.id,D.Descripcion,D.Total,D.Fecha_Creacion,TR.id_Dep,TR.id_Cot;');
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
                        <h1 class="text-center">EDITAR DEPOSITO</h1>
                    </div>
                    <div class="col-md-6 offset-md-3 mb-3">
                        @foreach($depositos as $dep)
                        <form class="row" method="post" action="{{ url('/Admin/Update/'.$id)}}">
                            {!! csrf_field() !!}
                            <div class="form-group col-12">
                                <label>DESCRIPCIÓN</label>
                                <input type="text" class="form-control" value="{{$dep->Descripcion }}" name="DESCR" required>
                            </div>
                            <div class="form-group col-6">
                                <label>CANTIDAD</label>
                                <input type="number" min="{{$dep->Cantidad }}" class="form-control" value="{{$dep->Total }}" name="CANTI" required>
                            </div>
                            <div class="form-group col-6">
                                <label>FECHA</label>
                                <input type="date" class="form-control" value="{{$dep->Fecha_Creacion }}" name="FECHA" required>
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
