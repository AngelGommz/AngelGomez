<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControladorForm extends Controller
{

//-----------------------------ADMINISTRADOR------------------------
    public function Admin(){return view('Administrador/Admin');}
    public function InserDep(){
        $data = request()->all();
        
        DB::insert('INSERT INTO depositos 
                (Descripcion, Total, Fecha_Creacion) VALUE 
                ("'.$data['DESCR'].'",
                "'.$data['CANTI'].'",
                "'.$data['FECHA'].'");');
        return redirect('/Admin');
    }    
    public function DeleteDep($id){
        DB::delete('DELETE FROM depositos WHERE id ="'.$id.'";' );
        return redirect('/Admin');
    }    
    public function UpdateDep($id){
        return view('Administrador/Depositos', compact('id'));
    }
    public function UpdateDep2($id){
        $data = request()->all();
        DB::update('UPDATE depositos
                    SET Descripcion = "'.$data['DESCR'].'",
                    Total = "'.$data['CANTI'].'",
                    Fecha_Creacion = "'.$data['FECHA'].'"
                    WHERE id = "'.$id.'";');
        return redirect('/Admin');
    }
    
//-----------------------------USUARIO------------------------------    
    public function Usua(){return view('Usuario/Usuario');}
    public function InserCot(){
        $data = request()->all();
        
        DB::insert('INSERT INTO cotizaciones 
                (`Folio`,`Cli_Nom`,`Cli_Email`,`Cli_Direccion`,`Aut_Marca`,`Aut_Modelo`,`Aut_Azo`,`Precio`,`Fecha_Creacion`) VALUE 
                ("'.$data['DatCot01'].'",
                "'.$data['DatCot02'].'",
                "'.$data['DatCot03'].'",
                "'.$data['DatCot04'].'",
                "'.$data['DatCot05'].'",
                "'.$data['DatCot06'].'",
                "'.$data['DatCot07'].'",
                "'.$data['DatCot08'].'",
                "'.date("Y-m-d").'");');
        return redirect('/Usuario');
    }
    
}



