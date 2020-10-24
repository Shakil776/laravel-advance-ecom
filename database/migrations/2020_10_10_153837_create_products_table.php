<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->integer('category_id');
            $table->integer('section_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_color');
            $table->float('product_price');
            $table->float('product_discount');
            $table->string('product_main_image');
            $table->string('product_video');
            $table->text('product_description');
            $table->string('product_fabric');
            $table->string('product_pattern');
            $table->string('product_sleeve');
            $table->string('product_fit');
            $table->string('product_meta_title');
            $table->string('product_meta_description');
            $table->string('product_meta_keywords');
            $table->enum('is_featured', ['Yes', 'No']);
            $table->tinyInteger('status');
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
}
