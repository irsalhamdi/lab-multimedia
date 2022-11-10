<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityDedicationGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_dedication_guides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('community_dedication_id');
            $table->string('name');
            $table->string('file');
            $table->timestamps();
            $table->foreign('community_dedication_id')->references('id')->on('community_dedications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community_dedication_guides');
    }
}
