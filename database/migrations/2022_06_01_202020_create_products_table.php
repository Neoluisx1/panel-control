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
            $table->foreignId('category_id')->constrained();
            $table->string('code', 25)->nullable();
            $table->string('name', 250);
            $table->string('change', 255)->nullable();
            $table->decimal('cost', 10,2)->default(0);
            $table->decimal('price', 10,2)->default(0);
            $table->decimal('price2', 10,2)->default(0);
            $table->integer('stock')->default(0);
            $table->integer('minstock')->default(0);
            $table->enum('unit_product',['Pieza'])->default('Pieza');
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
