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
        Schema::create('datphong', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_KH')->unsigned();
            $table->integer('id_Phong')->unsigned();
            $table->dateTime('NgayDat');
            $table->dateTime('NgayTra');
            $table->integer('U_id')->unsigned();
            $table->integer('id_SP')->unsigned();
            $table->integer('Ma_CTy')->unsigned();
            $table->integer('Ma_Dvi')->unsigned();
            $table->string('status');
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
        Schema::dropIfExists('datphong');
    }
};
