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
    public function UpdateCot($id){
        return view('Usuario/Editar', compact('id'));
    }
    public function UpdateCot2($id){
        $data = request()->all();
        DB::update('UPDATE cotizaciones
                    SET Folio       = "'.$data['DatCot01'].'",
                    Cli_Nom         = "'.$data['DatCot02'].'",
                    Cli_Email       = "'.$data['DatCot03'].'",
                    Cli_Direccion   = "'.$data['DatCot04'].'",
                    Aut_Marca       = "'.$data['DatCot05'].'",
                    Aut_Modelo      = "'.$data['DatCot06'].'",
                    Aut_Azo         = "'.$data['DatCot07'].'",
                    Precio          = "'.$data['DatCot08'].'"
                    WHERE id = "'.$id.'";');
        return redirect('/Usuario');
    }
    public function UpdateAbo($id){
        return view('Usuario/Abonar', compact('id'));
    }
    public function InstAbo($id){
        $data = request()->all();
        DB::insert('INSERT INTO rel_cot_deps (id_Dep,id_Cot,Cantidad) VALUES (
                    "'.$data['DatCot01'].'",
                    "'.$id.'",
                    "'.$data['DatCot02'].'");');
        return redirect('/Usuario/Abonar/'.$id);
    }
}



