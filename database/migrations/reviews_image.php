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
        Schema::table('review_images', function (Blueprint $table) {
            // Drop existing column
            $table->dropColumn('image');
        });
        
        Schema::table('review_images', function (Blueprint $table) {
            // Add new mediumBlob column using DB statement
            if (DB::connection()->getDriverName() === 'mysql') {
                DB::statement("ALTER TABLE review_images ADD image MEDIUMBLOB COMMENT 'BLOB storage for images (up to 16MB)'");
            } else {
                $table->binary('image')->comment('BLOB storage for images (up to 16MB)');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('review_images', function (Blueprint $table) {
            // Drop mediumBlob column
            $table->dropColumn('image');
        });
        
        Schema::table('review_images', function (Blueprint $table) {
            // Restore binary column
            $table->binary('image')->comment('BLOB storage for images');
        });
    }
};
