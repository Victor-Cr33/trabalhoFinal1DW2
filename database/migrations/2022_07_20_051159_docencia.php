<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Docencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('disciplina_id');   
            $table->unsignedBigInteger('professor_id');   
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');  
            $table->foreign('professor_id')->references('id')->on('professores'); 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docencias');
    }
}
