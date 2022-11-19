<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_categories_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('asistant_id');
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('user_id');
            $table->string('title')->unique();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->text('description');
            $table->text('excerpt');
            $table->timestamps();
            $table->foreign('news_categories_id')->references('id')->on('news_categories')->onDelete('cascade');
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
        Schema::dropIfExists('news');
    }
}
