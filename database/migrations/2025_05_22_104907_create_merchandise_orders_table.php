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
            $table->string('order_number');
            $table->integer('quantity');
            $table->integer('total_price');
            $table->enum('status', [ 'paid', 'shipped', 'completed'])->default('paid');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('merchandise_id')->constrained('merchandises')->onDelete('cascade');
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
