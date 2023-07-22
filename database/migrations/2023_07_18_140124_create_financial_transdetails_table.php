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
        Schema::create('financial_transdetails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('financialTranId');
            $table->bigInteger('moduleId');
            $table->decimal('amount', 65, 2);
            $table->bigInteger('headId');
            $table->bigInteger('brid');	
            $table->string('crdr');
            $table->string('head_name');
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
        Schema::dropIfExists('financial_transdetails');
    }
};
