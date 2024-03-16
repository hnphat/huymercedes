<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class XeTin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xe_tin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('hinhAnh');
            $table->string('slugName')->unique();
            $table->string('moTa');
            $table->string('thongSoKyThuat');
            $table->text('content');
            $table->integer('thuThap')->nullable();
            $table->boolean('quangCaoRamdom')->default(false);
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
        Schema::dropIfExists('xe_tin');
    }
}
