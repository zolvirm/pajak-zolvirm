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
        Schema::create('pemiliks', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('dusun');
            $table->tinyInteger('RT');
            $table->tinyInteger('RW');
            $table->text('alamat', 255);
            $table->timestamps();
            // untuk soft delete
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
        Schema::dropIfExists('pemiliks');
    }
};
