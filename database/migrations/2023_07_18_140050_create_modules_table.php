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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->bigInteger('ModuleID');
            $table->timestamps();
            $table->index(['module']);
        });

        DB::table('modules')->insert([
            ['id' => 1, 'module' => 'Academic', 'ModuleID' => 1, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 2, 'module' => 'Academic Misc', 'ModuleID' => 11, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'module' => 'Hostel', 'ModuleID' => 2, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'module' => 'Hostel Misc', 'ModuleID' => 22, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'module' => 'Transport', 'ModuleID' => 3, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'module' => 'Transport Misc', 'ModuleID' => 33, 'created_at' => NULL, 'updated_at' => NULL]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
};
