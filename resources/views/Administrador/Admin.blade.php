<?php 
use Illuminate\Support\Facades\DB;
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
                        <a href="{{ url('/')}}">
                            <button type="button" class="btn btn-secondary">INICIO</button>                        
                        </a>
                    </div>
                    <div class="col-12">
                        <h1 class="text-center">DEPOSITOS</h1>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <h4 class="text-center">Nuveo Deposito</h4>
                    </div>
                    <div class="col-md-6 offset-md-3 mb-3">
                        <form class="row" method="post" action="{{ url('/Admin')}}">
                            {!! csrf_field() !!}
                            <div class="form-group col-12">
                                <label>DESCRIPCIÓN</label>
                                <input type="text" class="form-control" name="DESCR" autocomplete="off" required>
                            </div>
                            <div class="form-group col-6">
                                <label>CANTIDAD</label>
                                <input type="number" class="form-control" name="CANTI" autocomplete="off" required>
                            </div>
                            <div class="form-group col-6">
                                <label>FECHA</label>
                                <input type="date" class="form-control" name="FECHA">
                            </div>
                            <button type="submit" class="btn btn-primary col-4 offset-8">AGREGAR</button>
                        </form>
                    </div>
                    <div class="col-md-10 offset-md-1">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Pagado</th>
                                        <th scope="col">Fecha de Creación</th>
                                        <th scope="col">Estatus</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($depositos as $dep)
                                    <tr>
                                        <td>{{$dep->Descripcion }}</td>
                                        <td>${{number_format($dep->Total, 2, '.', ',')  }}</td>
                                        <td>${{number_format($dep->Cantidad, 2, '.', ',')  }}</td>
                                        <td>{{date("d-m-Y", strtotime($dep->Fecha_Creacion)) }}</td>
                                        @if(number_format($dep->Total, 2, '.', ',') == number_format($dep->Cantidad, 2, '.', ','))
                                        <td>PAGADO</td>
                                        @else
                                        <td>PENDIENTE</td>
                                        @endif
                                        <td>
                                            <a href="{{ url('/Admin/Editar/'.$dep->id) }}">
                                                <button type="button" class="btn btn-primary col-12">EDITAR</button>
                                            </a>        
                                        </td>
                                        @if(number_format($dep->Cantidad, 2, '.', ',') == 0)
                                        <td>
                                            <a href="{{ url('/Admin/Eliminar/'.$dep->id) }}">
                                                <button type="button" class="btn btn-danger col-12">ELIMINAR</button>
                                            </a>
                                        </td>
                                        @else
                                        <td></td>
                                        @endif
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
