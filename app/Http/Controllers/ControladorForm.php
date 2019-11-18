<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControladorForm extends Controller
{
    public function Admin(){
        return view('Administrador/Admin');
    }
    public function InserDep(){
        $data = request()->all();
        
        DB::insert('INSERT INTO depositos 
                (Descripcion, Total, Fecha_Creacion) VALUE 
                ("'.$data['DESCR'].'",
                "'.$data['CANTI'].'",
                "'.$data['FECHA'].'");');
        return view('Administrador/Admin');
        //Al refrescar la pagina se incerta nuevamente el campo, no e econtrado la manera paraa que se borre la variable
    }
}
