<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Folio',10);
            $table->string('Cli_Nom',60);
            $table->string('Cli_Email',80);
            $table->text('Cli_Direccion');
            $table->string('Aut_Marca',30);
            $table->string('Aut_Modelo',15);
            $table->string('Aut_Azo',7);
            $table->string('Precio',10);
            $table->date('Fecha_Creacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizaciones');
    }
}
