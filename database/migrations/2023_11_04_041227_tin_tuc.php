<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TinTuc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tin_tuc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slugName')->unique();
            $table->string('hinhAnh');
            $table->string('moTa');
            $table->text('content');
            $table->enum('loaiTin', ['KM', 'HAGI', 'KINHNGHIEM', 'KHAC']);
            $table->integer('thuThap')->nullable();
            $table->boolean('quangCaoRamdom')->default(false);
            $table->boolean('show')->default(false);
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
        Schema::dropIfExists('tin_tuc');
    }
}
