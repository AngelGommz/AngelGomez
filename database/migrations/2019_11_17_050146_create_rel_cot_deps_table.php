<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelCotDepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_cot_deps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_Dep');
            $table->integer('id_Cot');
            $table->string('Cantidad', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_cot_deps');
    }
}
