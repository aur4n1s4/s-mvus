<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntriansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->id()
                ->autoIncrement()
                ->unsigned();
            $table->string('no_antrian');
            $table->dateTime('tanggal');
            $table->tinyInteger('status')
                ->comment('0: Menunggu 1: Dalam pemeriksaan 2: Selesai');
            $table->foreignId('pengunjung_id')
                ->unsigned()
                ->constrained('pengunjungs')
                ->onDelete('cascade');
            $table->foreignId('poli_id')
                ->unsigned()
                ->constrained('polis')
                ->onDelete('cascade');
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
        Schema::dropIfExists('antrians');
    }
}
