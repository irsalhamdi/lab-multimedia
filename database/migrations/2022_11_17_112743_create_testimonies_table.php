<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimoniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('asistant_id')->nullable();
            $table->unsignedBigInteger('dosen_id')->nullable();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('testimoni');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('asistant_id')->references('id')->on('asistants')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('dosens')->onDelete('cascade');
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
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
        Schema::dropIfExists('testimonies');
    }
}
