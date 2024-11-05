<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsentifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insentifs', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable(false);
            $table->unsignedInteger('jenis_insentif_id')->index()->nullable(false);
            $table->unsignedInteger('jenis_publikasi_id')->index()->nullable(false);
            $table->unsignedInteger("dosen_ketua_id")->index()->nullable(false);
            $table->string("penulis_anggota")->nullable();
            $table->string('jurnal')->nullable();
            $table->string('jumlah')->nullable(false);
            $table->year('tahun');
            $table->boolean('status')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insentifs');
    }
}
