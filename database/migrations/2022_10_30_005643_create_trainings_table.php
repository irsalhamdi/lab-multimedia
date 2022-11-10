<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_categories_id');
            $table->string('name')->unique();
            $table->text('description');
            $table->string('image')->nullable();
            $table->text('participants');
            $table->string('place');
            $table->dateTime('date');
            $table->string('zoom')->nullable();
            $table->string('whatsapp')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('training_categories_id')->references('id')->on('training_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
}
