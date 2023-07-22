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
        Schema::table('phong', function (Blueprint $table) {
            $table->foreign('idTang')->references('id')->on('tang')->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('idLoaiPhong')->references('id')->on('loaiphong')->onDelete('cascade')->onUpdate('cascade'); 
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

