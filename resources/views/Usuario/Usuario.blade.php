<?php 
use Illuminate\Support\Facades\DB;
$cotizaciones = DB::select('SELECT C.id,C.Folio,C.Cli_Nom,C.Cli_Email,C.Cli_Direccion,C.Aut_Marca,C.Aut_Modelo,C.Aut_Azo,C.Precio,C.Fecha_Creacion,TR.id_Cot,SUM(TR.Cantidad) AS Cantidad
                        FROM cotizaciones As C 
                        LEFT JOIN rel_cot_deps as TR ON C.id = TR.id_Cot
                        GROUP BY C.id,C.Folio,C.Cli_Nom,C.Cli_Email,C.Cli_Direccion,C.Aut_Marca,C.Aut_Modelo,C.Aut_Azo,C.Precio,C.Fecha_Creacion,TR.id_Cot
                        ORDER BY C.Fecha_Creacion;');
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
                        <h1 class="text-center">COTIZACIONES</h1>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <h4 class="text-center">Nueva Cotización</h4>
                    </div>
                    <div class="col-md-8 offset-md-2 mb-3">
                        <form class="row" method="post" action="{{ url('/Cotizacion')}}">
                            {!! csrf_field() !!}
                            <div class="form-group col-12">
                                <label>FOLIO</label>
                                <input type="text" class="form-control" name="DatCot01" autocomplete="off" required>
                            </div>
                            <div class="form-group col-12 row">
                                <div class="col-12">
                                    <label>INFORMACION DEL CLIENTE</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="DatCot02" placeholder="NOMBRE" autocomplete="off" required>
                                </div>
                                <div class="col-6">
                                    <input type="email" class="form-control" name="DatCot03" placeholder="EMAIL" autocomplete="off" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="DatCot04" placeholder="DIRECCIÓN" autocomplete="off" required>
                                </div>                                
                            </div>
                            <div class="form-group col-12 row">
                                <div class="col-12">
                                    <label>AUTO</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" name="DatCot05" placeholder="MARCA" autocomplete="off" required>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" name="DatCot06" placeholder="MODELO" autocomplete="off" required>
                                </div>
                                <div class="col-4">
                                    <input type="number" class="form-control" name="DatCot07" placeholder="AÑO" autocomplete="off" required>
                                </div>                                
                            </div>
                            <div class="form-group col-12">
                                <label>PRECIO</label>
                                <input type="number" class="form-control" name="DatCot08" required>
                            </div>
                            <button type="submit" class="btn btn-primary col-4 offset-8">AGREGAR</button>
                        </form>
                    </div>
                    <div class="col-md-10 offset-md-1">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Folio</th>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Auto</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Fecha Creacion</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Abonar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cotizaciones as $cot)
                                    <tr>
                                        <td>{{ $cot->Folio }}</td>
                                        <td>{{ $cot->Cli_Nom.', '.$cot->Cli_Email.', '.$cot->Cli_Direccion }}</td>
                                        <td>{{ $cot->Aut_Marca.' / '.$cot->Aut_Modelo.' / '.$cot->Aut_Azo }}</td>
                                        <td>${{ number_format($cot->Precio, 2, '.', ',') }}</td>
                                        <td>${{ number_format($cot->Cantidad, 2, '.', ',') }}</td>
                                        <td>{{ date("d-m-Y", strtotime($cot->Fecha_Creacion)) }}</td>
                                        <td>
                                            <a href="{{ url('/Usuario/Editar/'.$cot->id) }}">
                                                <button type="button" class="btn btn-primary col-12">EDITAR</button>
                                            </a>        
                                        </td>
                                        <td>
                                            <a href="{{ url('/Usuario/Abonar/'.$cot->id) }}">
                                                <button type="button" class="btn btn-success col-12">ABONAR</button>
                                            </a>        
                                        </td>
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
