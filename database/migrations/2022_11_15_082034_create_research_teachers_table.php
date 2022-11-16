<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_id');
            $table->string('title');
            $table->string('image');
            $table->text('description');
            $table->text('excerpt');
            $table->dateTime('date');
            $table->integer('participants');
            $table->timestamps();
            $table->foreign('dosen_id')->references('id')->on('dosens')->onDelete('casacade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_teachers');
    }
}
