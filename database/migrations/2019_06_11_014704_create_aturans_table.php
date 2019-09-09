<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAturansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aturans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor');
            $table->string('nomor_index');
            $table->text('perihal');
            $table->longtext('isi');
            $table->integer('aturan_jenis_id');
            $table->integer('aturan_info_id');
            $table->string('lampiran')->nullable();
            $table->string('pdf')->nullable();
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
        Schema::dropIfExists('aturans');
    }
}
