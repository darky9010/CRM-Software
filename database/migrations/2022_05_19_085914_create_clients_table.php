<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('name');
            $table->string('surname');
            $table->string('address');
            $table->string('address1')->nullable();
            $table->string('postal_code');
            $table->string('city');
            $table->string('region');
            $table->date('birthday')->nullable();
            $table->string('phone');
            $table->string('mail')->nullable();
            $table->tinyInteger('ffse')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
