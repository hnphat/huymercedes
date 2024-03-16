<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ViTriXe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vi_tri_xe', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idXe')->unsigned();
            $table->foreign('idXe')->references('id')->on('xe');
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
        Schema::dropIfExists('vi_tri_xe');
    }
}
