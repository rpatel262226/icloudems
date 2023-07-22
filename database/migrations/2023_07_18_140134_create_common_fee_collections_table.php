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
        Schema::create('common_fee_collections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('moduleId');
            $table->bigInteger('transId');
            $table->string('admno');
            $table->string('rollno');	
            $table->decimal('amount', 65, 2);
            $table->bigInteger('brId');
            $table->string('acadamicYear');
            $table->string('financialYear');
            $table->string('displayReceiptNo');
            $table->integer('Entrymode');
            $table->string('PaidDate')->nullable();
            $table->integer('inactive')->nullable();
            $table->timestamps();
            $table->index(['admno','Entrymode','PaidDate','brId']);
            $table->foreign('brId')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('common_fee_collections');
    }
};
