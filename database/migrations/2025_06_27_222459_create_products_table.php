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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
