<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateClearenceLaboratoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_clearence_laboratories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('generation');
            $table->string('title_of_thesis');
            $table->string('dosen');
            $table->string('necessity');
            $table->tinyInteger('basis_data')->default(0)->nullable();
            $table->tinyInteger('multimedia')->default(0)->nullable();
            $table->tinyInteger('robotika')->default(0)->nullable();
            $table->tinyInteger('elektronika')->default(0)->nullable();
            $table->tinyInteger('perangkat_keras')->default(0)->nullable();
            $table->tinyInteger('struktur_data')->default(0)->nullable();
            $table->tinyInteger('pemrograman_lanjut')->default(0)->nullable();
            $table->tinyInteger('instrumen')->default(0)->nullable();
            $table->tinyInteger('kecerdasan')->default(0)->nullable();
            $table->tinyInteger('jaringan')->default(0)->nullable();
            $table->tinyInteger('pengolahan')->default(0)->nullable();
            $table->tinyInteger('rpl')->default(0)->nullable();
            $table->tinyInteger('pemrograman_dasar')->default(0)->nullable();
            $table->tinyInteger('pemrograman_internet')->default(0)->nullable();
            $table->string('kpm');
            $table->string('form_ta');
            $table->string('form_proposal');
            $table->string('form_pengesahan_kp');
            $table->string('form_kp');
            $table->string('signature')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificate_clearence_laboratories');
    }
}
