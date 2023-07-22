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
        Schema::create('csv_temp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date_c')->nullable();
            $table->string('academic_year_c')->nullable();
            $table->string('session_c')->nullable();
            $table->string('voucher_type_c')->nullable();
            $table->string('voucher_no_c')->nullable();
            $table->string('roll_no_c')->nullable();
            $table->string('admno_c')->nullable();
            $table->string('fee_category_c')->nullable();
            $table->string('faculty_c')->nullable();
            $table->string('receipt_no_c')->nullable();
            $table->string('fee_head_c')->nullable();
            $table->decimal('due_amount_c', 65, 2)->nullable();
            $table->decimal('paid_amount_c', 65, 2)->nullable();
            $table->decimal('concession_amount_c', 65, 2)->nullable();
            $table->decimal('scholarship_amount_c', 65, 2)->nullable();
            $table->decimal('reverse_concession_amount_c', 65, 2)->nullable();
            $table->decimal('write_off_amount_c', 65, 2)->nullable();
            $table->decimal('adjusted_amount_c', 65, 2)->nullable();
            $table->decimal('refund_amount_c', 65, 2)->nullable();
            $table->decimal('fund_tranCfer_amount_c', 65, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csv_temp');
    }
};
