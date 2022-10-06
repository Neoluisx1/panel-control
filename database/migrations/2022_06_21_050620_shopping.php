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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            
            $table->unsignedBigInteger('provider_id');            
            $table->foreign('provider_id')->references('id')->on('providers');


            $table->string('references',100);
            $table->decimal('total',10,2)->default(0);
            $table->decimal('payment',10,2)->default(0);
            $table->enum('pay_status',['Pagado','Pendiente'])->default('Pagado'); 
            $table->enum('status',['Recibido','Pendiente'])->default('Recibido');            
            $table->unsignedBigInteger('user_register');
            $table->foreign('user_register')->references('id')->on('users');
            $table->unsignedBigInteger('user_edit');
            $table->foreign('user_edit')->references('id')->on('users');
            $table->unsignedBigInteger('branchoffice_id');            
            $table->foreign('branchoffice_id')->references('id')->on('branchoffices');
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
