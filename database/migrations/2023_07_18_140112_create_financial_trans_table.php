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
        Schema::create('financial_trans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('moduleid');
            $table->bigInteger('tranid');
            $table->string('admno');
            $table->decimal('amount', 65, 2);	
            $table->string('crdr');
            $table->string('tranDate'); 
            $table->string('acadYear');
            $table->integer('Entrymode');
            $table->bigInteger('voucherno');
            $table->unsignedBigInteger('brid');
            $table->bigInteger('type_of_concession')->nullable();            
            $table->timestamps();
            $table->index(['admno','crdr','Entrymode','brid','voucherno']);
            $table->foreign('brid')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financial_trans');
    }
};
