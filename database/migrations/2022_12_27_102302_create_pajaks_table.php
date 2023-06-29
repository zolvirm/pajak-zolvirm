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
        Schema::create('pajaks', function (Blueprint $table) {
            $table->id();
            $table->char('NOP', 18)->unique();
            $table->string('nama');
            $table->integer('yang_harus_dibayar');
            $table->integer('tahun');
            $table->foreignId('pemilik_id')->nullable();
            $table->boolean('status')->default('0');
            $table->timestamps();
            //untuk softdelete
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pajaks');
    }
};
