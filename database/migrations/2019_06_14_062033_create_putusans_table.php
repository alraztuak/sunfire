<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePutusansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('putusans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('putusan_cat_id');
            $table->integer('putusan_jenis_id');
            $table->string('tahun');
            $table->text('judul');
            $table->text('info');
            $table->longtext('isi');
            $table->string('views');
            $table->string('status');
            $table->string('create_by');
            $table->string('update_by');
            $table->timestamp('published_at');
            $table->softDeletes();
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
        Schema::dropIfExists('putusans');
    }
}
