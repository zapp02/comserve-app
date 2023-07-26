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
        Schema::table('products', function (Blueprint $table) {
            $table ->dropColumn('price');
            $table ->dropColumn('discount');
            $table ->dropColumn('material');
            $table ->dropColumn('tags');
            $table ->dropColumn('sku');
            $table ->dropColumn('size');
            $table ->dropColumn('color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table ->integer('price');
            $table ->integer('discount');
            $table ->string('material');
            $table ->string('tags');
            $table ->string('sku');
            $table ->string('size');
            $table ->string('color');
        });
    }
};
