<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('user_id')->unsigned()->nullable(true);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nik', 16);
            $table->string('first_name', 191);
            $table->string('last_name', 191)->nullable(true);
            $table->char('phone_number', 14);
            $table->string('email', 191);
            $table->enum('gender', ['L', 'P']);
            $table->string('t_lahir', 191);
            $table->date('d_lahir');
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
        Schema::dropIfExists('pegawais');
    }
}
