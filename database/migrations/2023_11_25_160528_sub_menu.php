<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMenu')->unsigned();
            $table->foreign('idMenu')->references('id')->on('menu');
            $table->string('name');
            $table->boolean('isBaiViet')->default(true);
            $table->string('link')->nullable();
            $table->integer('baiViet')->nullable();
            $table->boolean('isShow')->default(true);
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
        Schema::dropIfExists('sub_menu');
    }
}
