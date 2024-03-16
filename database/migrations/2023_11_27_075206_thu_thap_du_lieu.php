<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ThuThapDuLieu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thu_thap_du_lieu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hoTen');
            $table->string('soDienThoai');
            $table->string('diaChi')->nullable();
            $table->string('xeYeuCau')->nullable();
            $table->string('linkReg')->nullable();
            $table->string('yeuCauKhachHang')->nullable();
            $table->boolean('isOld')->default(true);
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
        Schema::dropIfExists('thu_thap_du_lieu');
    }
}
