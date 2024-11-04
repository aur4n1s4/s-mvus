<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengunjungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengunjungs', function (Blueprint $table) {
            $table->id()
                ->autoIncrement()
                ->unsigned();
            $table->string('nik', 16)->unique();
            $table->string('nama');
            $table->string('telepon');
            $table->text('alamat');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->integer('usia');
            $table->date('t_lahir');
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
        Schema::dropIfExists('pengunjungs');
    }
}
