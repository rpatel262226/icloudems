<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_collection_types', function (Blueprint $table) {
            $table->id();
            $table->string('collectionhead');
            $table->longText('collectiondesc');
            $table->bigInteger('br_id');
            $table->timestamps();
            $table->index(['collectionhead','br_id']);
            $table->foreign('br_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_collection_types');
    }
};
