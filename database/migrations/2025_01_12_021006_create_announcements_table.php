<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id(); // Primary key (auto-incremented)
            $table->string('title', 100); // Title of the announcement (max 100 characters)
            $table->string('image', 255)->nullable(); // Image path (optional, max 255 characters)
            $table->text('message'); // Message (long text, no length limit)
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('announcements'); // Drop the table if it exists
    }
}
