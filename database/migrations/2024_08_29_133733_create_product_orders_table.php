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
        Schema::create('product_orders', function (Blueprint $table) {
            // $table->id(); 
            // $table->foreignId('product_id')->constrained()->onDelete('cascade');
            // $table->integer('quantity')->default(1); 
            // $table->string('color', 50)->nullable(); 
            // $table->string('size', 50)->nullable(); 
            // $table->decimal('total', 10, 2); 
            // $table->timestamps();
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_orders');
    }
};
