<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description");
            $table->string("productCode")->nullable();
            $table->string("color")->nullable();
            $table->double("price")->default(0);
            $table->double("sale_price")->default(0);
            $table->string("size")->nullable();
            $table->string("image");
            $table->integer("stock")->default(0);
            $table->boolean('is_active')->default(1);
            $table->foreignId('categories_id')->constrained();
            $table->foreignId('sub_categories_id')->constrained();
            $table->foreignId('brands_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
