<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchTeacherGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_teacher_guides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('research_id');
            $table->string('name');
            $table->string('file');
            $table->timestamps();
            $table->foreign('research_id')->references('id')->on('research_teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_teacher_guides');
    }
}
