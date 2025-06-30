<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('medical_records', function (Blueprint $table) {
        $table->string('image')->nullable()->after('doctor');
    });
}

public function down()
{
    Schema::table('medical_records', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}
};
