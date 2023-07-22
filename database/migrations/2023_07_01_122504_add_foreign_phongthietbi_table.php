<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phongthietbi', function (Blueprint $table) {
            $table->foreign('id_Phong')->references('id')->on('phong')->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('id_TB')->references('id')->on('thietbi')->onDelete('cascade')->onUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

