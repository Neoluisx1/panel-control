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
        Schema::create('purchases_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('purchase_id')->constrained();

            $table->foreignId('product_id')->constrained();

            $table->integer('quantity');

            $table->decimal('price', 10,2)->default(0);

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
        //
    }
};
