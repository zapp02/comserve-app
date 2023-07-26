<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders_details', function (Blueprint $table) {
            $table ->string ('purpose');
            $table ->string ('period');
            $table ->string ('location');
            $table ->integer ('obtained');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders_details', function (Blueprint $table) {
            $table ->dropColumn ('purpose');
            $table ->dropColumn ('period');
            $table ->dropColumn ('location');
            $table ->dropColumn ('obtained');
        });
    }
};
