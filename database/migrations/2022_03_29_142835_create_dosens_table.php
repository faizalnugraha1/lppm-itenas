<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('password');
            $table->string('nidn');
            $table->string('jurusan')->nullable();
            $table->string('email')->unique();
            $table->string('pict')->default('default_profile_picture.jpg');
            $table->string('gs_id')->nullable();
            $table->string('sinta_id')->nullable();
            $table->string('scopus_id')->nullable();
            $table->string('keahlian')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('dosens');
    }
}
