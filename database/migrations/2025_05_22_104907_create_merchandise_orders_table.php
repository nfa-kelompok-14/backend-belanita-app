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
        Schema::create('merchandise_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->integer('total_price');
            $table->enum('status', ['pending', 'paid', 'shipped', 'completed']);
            $table->integer('users_id');
            $table->integer('merchandise_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchandise_orders');
    }
};
