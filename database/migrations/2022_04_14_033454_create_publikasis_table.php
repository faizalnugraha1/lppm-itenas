<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publikasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable(false);
            $table->unsignedInteger("dosen_ketua_id")->index()->nullable(false);
            $table->string("ketua_external")->nullable();
            $table->string("penulis_anggota")->nullable();
            $table->string("penulis_external")->nullable();
            $table->string('jurnal')->nullable();
            $table->string('url')->nullable(false);
            $table->unsignedInteger("jenis_publikasi_id")->index()->nullable();
            $table->string('sumber_dana')->nullable();
            $table->string('lingkup')->nullable();
            $table->date('tanggal_publish');
            $table->year('tahun');
            $table->integer('jumlah')->nullable(false);
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
        Schema::dropIfExists('publikasis');
    }
}
