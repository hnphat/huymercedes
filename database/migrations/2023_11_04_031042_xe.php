<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Xe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xe', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idDongXe')->unsigned();
            $table->foreign('idDongXe')->references('id')->on('dong_xe');
            $table->string('name');
            $table->string('slugName')->unique();
            $table->string('loaiXe');
            $table->string('hopSo');
            $table->string('nhienLieu');
            $table->string('choNgoi');
            $table->integer('giaBan');
            $table->string('hinhAnh');
            $table->boolean('isNew')->default(false);
            $table->boolean('isKhuyenMai')->default(false);
            $table->boolean('isShow')->default(true);
            $table->integer('position')->default(0);
            $table->integer('tinXe')->unsigned();
            $table->foreign('tinXe')->references('id')->on('xe_tin');
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
        Schema::dropIfExists('xe');
    }
}
