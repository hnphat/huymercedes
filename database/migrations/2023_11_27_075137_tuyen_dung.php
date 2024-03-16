<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TuyenDung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuyen_dung', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hoTen');
            $table->string('ngaySinh');
            $table->string('soDienThoai');
            $table->string('hinhAnh');
            $table->string('CV');
            $table->string('trinhDo');
            $table->string('viTriUngTuyen');
            $table->string('cauHoiUngVien')->nullable();
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
        Schema::dropIfExists('tuyen_dung');
    }
}
