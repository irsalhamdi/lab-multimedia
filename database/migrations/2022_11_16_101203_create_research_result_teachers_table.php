<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchResultTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_result_teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('research_teacher_id');
            $table->string('file');
            $table->timestamps();
            $table->foreign('research_teacher_id')->references('id')->on('research_teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_result_teachers');
    }
}
