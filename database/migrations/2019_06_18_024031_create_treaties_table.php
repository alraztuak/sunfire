<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treaties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('treaty_info_id');
            $table->integer('treaty_jenis_id');
            $table->string('kode');
            $table->text('judul');
            $table->longtext('isi_id');
            $table->longtext('isi_en');
            $table->string('views');
            $table->string('status');
            $table->string('create_by');
            $table->string('update_by');
            $table->timestamp('signed_at')->nullable();
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('treaties');
    }
}
