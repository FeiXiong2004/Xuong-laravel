<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Products;
use App\Models\ProductSize;
use App\Models\ProductColor;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Products::class)->constrained();
            $table->foreignIdFor(ProductSize::class)->constrained();
            $table->foreignIdFor(ProductColor::class)->constrained();
            $table->unsignedInteger('quantity')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->unique(['products_id','product_size_id','product_color_id'],'product_variants_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
