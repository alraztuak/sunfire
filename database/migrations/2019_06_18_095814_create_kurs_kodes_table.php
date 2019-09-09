<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKursKodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kurs_kodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode');
            $table->string('judul');
            $table->string('satuan');
            $table->integer('kursmk')->nullable();
            $table->integer('kursbi')->nullable();
            $table->string('splash');
            $table->string('status');
            $table->string('create_by');
            $table->string('update_by');
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
        Schema::dropIfExists('kurs_kodes');
    }
}
