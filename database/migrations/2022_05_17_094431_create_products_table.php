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
            $table->string('name');
            $table->longText('description');
            $table->decimal('b_price'); //prezzo d'acquisto
            $table->decimal('s_price'); //prezzo di vendita
            $table->integer('stock');
            $table->integer('in_order'); //pezzi ordinati
            $table->integer('re_order'); //limite per il riordine
            $table->integer('location_A');
            $table->integer('location_B');
            $table->integer('location_C');
            $table->string('unit');
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
