<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kpp_jenis_id');
            $table->string('kodekpp');
            $table->string('kodewil');
            $table->string('nama');
            $table->string('kota');
            $table->string('lurah');
            $table->string('camat');
            $table->longtext('alamat');
            $table->string('telepon');
            $table->string('fax');
            $table->string('views');
            $table->string('status');
            $table->string('create_by');
            $table->string('update_by');
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
        Schema::dropIfExists('kpps');
    }
}
