<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::table('alamats', function (Blueprint $table) {

        //     $table->renameColumn('kota_id', 'city_id');

        // });

        DB::statement('ALTER TABLE alamats CHANGE kota_id city_id INT');

        Schema::table('alamats', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id')->change();
            $table->unsignedBigInteger('province_id')->change();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alamats', function (Blueprint $table) {
            //
        });
    }
};
