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
        Schema::table('datphong', function (Blueprint $table) {
            $table->foreign('id_KH')->references('id')->on('khachhang')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_Phong')->references('id')->on('phong')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('U_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_SP')->references('id')->on('sanpham')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Ma_CTy')->references('id')->on('congty')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Ma_Dvi')->references('id')->on('donvi')->onDelete('cascade')->onUpdate('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};

