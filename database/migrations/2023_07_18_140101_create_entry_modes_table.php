<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_modes', function (Blueprint $table) {
            $table->id();
            $table->string('entry_mode_name');
            $table->integer('entry_mode');
            $table->string('crdr');
            $table->integer('additional_for_actInact')->nullable();
            $table->integer('additional_for_concessionct')->nullable();
            $table->string('table_for_entry');
            $table->integer('csv_row_num')->nullable();
            $table->timestamps();
        });

        DB::table('entry_modes')->insert([
            ['id' => 1, 'entry_mode_name' => 'CONCESSION', 'entry_mode' => 15, 'crdr' => 'C', 'additional_for_actInact' => NULL, 'additional_for_concessionct' => 1, 'table_for_entry' => 'financial_trans', 'csv_row_num' => 19],
            ['id' => 2, 'entry_mode_name' => 'DUE', 'entry_mode' => 0, 'crdr' => 'D', 'additional_for_actInact' => NULL, 'additional_for_concessionct' => NULL, 'table_for_entry' => 'financial_trans', 'csv_row_num' => 17],
            ['id' => 3, 'entry_mode_name' => 'REVDUE', 'entry_mode' => 12, 'crdr' => 'C', 'additional_for_actInact' => NULL, 'additional_for_concessionct' => NULL, 'table_for_entry' => 'financial_trans', 'csv_row_num' => 22],
            ['id' => 4, 'entry_mode_name' => 'REVCONCESSION', 'entry_mode' => 16, 'crdr' => 'D', 'additional_for_actInact' => NULL, 'additional_for_concessionct' => NULL, 'table_for_entry' => 'financial_trans', 'csv_row_num' => 21],
            ['id' => 5, 'entry_mode_name' => 'REVSCHOLARSHIP', 'entry_mode' => 16, 'crdr' => 'D', 'additional_for_actInact' => NULL, 'additional_for_concessionct' => NULL, 'table_for_entry' => 'financial_trans', 'csv_row_num' => 21],
            ['id' => 6, 'entry_mode_name' => 'SCHOLARSHIP', 'entry_mode' => 15, 'crdr' => 'C', 'additional_for_actInact' => NULL, 'additional_for_concessionct' => 2,'table_for_entry' => 'financial_trans', 'csv_row_num' => 20],
            ['id' => 7, 'entry_mode_name' => 'RCPT', 'entry_mode' => 0, 'crdr' => 'C', 'additional_for_actInact' => 0, 'additional_for_concessionct' => NULL, 'table_for_entry' => 'common_fee_collections', 'csv_row_num' => 18],
            ['id' => 8, 'entry_mode_name' => 'REVRCPT', 'entry_mode' => 0, 'crdr' => 'D', 'additional_for_actInact' => NULL, 'additional_for_concessionct' => NULL, 'table_for_entry' => 'common_fee_collections', 'csv_row_num' => 18],
            ['id' => 9, 'entry_mode_name' => 'FUNDTRANSFER', 'entry_mode' => 1, 'crdr' => 'POSITIVE AND NEGATIVE', 'additional_for_actInact' => NULL, 'additional_for_concessionct' => NULL, 'table_for_entry' => 'common_fee_collections', 'csv_row_num' => 25],
            ['id' => 10, 'entry_mode_name' => 'PMT', 'entry_mode' => 1, 'crdr' => 'D', 'additional_for_actInact' => 0, 'additional_for_concessionct' => NULL, 'table_for_entry' => 'common_fee_collections', 'csv_row_num' => 24],
            ['id' => 11, 'entry_mode_name' => 'REVPMT', 'entry_mode' => 1, 'crdr' => 'C', 'additional_for_actInact' => 1, 'additional_for_concessionct' => NULL, 'table_for_entry' => 'common_fee_collections', 'csv_row_num' => 24],
            ['id' => 12, 'entry_mode_name' => 'JV', 'entry_mode' => 14, 'crdr' => 'C', 'additional_for_actInact' => 0, 'additional_for_concessionct' => NULL, 'table_for_entry' => 'common_fee_collections', 'csv_row_num' => 23],
            ['id' => 13, 'entry_mode_name' => 'REVJV', 'entry_mode' => 14, 'crdr' => 'D', 'additional_for_actInact'=>1,'additional_for_concessionct'=>NULL,'table_for_entry'=>'common_fee_collections','csv_row_num'=>23]
        ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entry_modes');
    }
};
