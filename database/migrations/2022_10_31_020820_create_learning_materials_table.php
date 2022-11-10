<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id');
            $table->string('name');
            $table->text('file');
            $table->timestamps();
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learning_materials');
    }
}
