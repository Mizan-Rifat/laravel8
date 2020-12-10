<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedinteger('category_id')->nullable();
            $table->longText('image')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price',12,4)->nullable();
            $table->string('price_currency')->default('BDT');
            $table->unsignedinteger('active')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
