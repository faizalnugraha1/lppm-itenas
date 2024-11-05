<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pembuat_id')->index()->nullable(false);
            $table->string('jenis_surat')->nullable(false);
            $table->string('no_surat')->nullable(false);
            $table->string('nama_kegiatan')->nullable(false);
            $table->unsignedInteger('kegiatan_id')->index()->nullable(false);
            $table->string('qr');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('surats');
    }
}
