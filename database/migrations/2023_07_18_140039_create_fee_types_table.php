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
        Schema::create('fee_types', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fee_category');
            $table->string('f_name');
            $table->bigInteger('Collection_id');
            $table->bigInteger('br_id');
            $table->bigInteger('Seq_id');
            $table->string('Fee_type_ledger');
            $table->bigInteger('Fee_headtype');
            $table->timestamps();
            $table->index(['br_id']);
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
        Schema::dropIfExists('fee_types');
    }
};
