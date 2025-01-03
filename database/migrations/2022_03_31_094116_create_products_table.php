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
            $table->string("name", 255)->nullable();
            $table->text("description")->nullable();
            $table->text("size")->nullable();
            $table->text("light")->nullable();
            $table->text("water")->nullable();
            $table->text("growth")->nullable();
            $table->text("pet")->nullable();
            $table->text("catagory")->nullable();
            $table->text("session")->nullable();
            $table->string("image", 255)->nullable(); // Main image
            $table->json('gallery_images')->nullable(); // Gallery images
            $table->decimal("price", 8, 2); // Price with larger precision
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
