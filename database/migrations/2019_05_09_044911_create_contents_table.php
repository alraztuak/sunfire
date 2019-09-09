<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('beritas');
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('content_cat_id');
            $table->text('judul');
            $table->string('sumber');
            $table->text('info');
            $table->longtext('isi');
            $table->string('url');
            $table->string('splash');
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
        Schema::dropIfExists('contents');
    }
}
