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
        Schema::create('common_fee_collection_headwises', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('moduleId');
            $table->bigInteger('receiptId');
            $table->bigInteger('headId');
            $table->string('headName');	
            $table->bigInteger('brid');
            $table->decimal('amount', 65, 2);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('common_fee_collection_headwises');
    }
};
