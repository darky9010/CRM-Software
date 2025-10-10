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
            $table->string('language');
            $table->string('title');
            $table->string('rank');
            $table->string('name');
            $table->string('surname');
            $table->string('function');
            $table->string('company')->nullable();
            $table->string('address')->nullable();
            $table->string('address1')->nullable();
            $table->string('postal_code');
            $table->string('city');
            $table->string('region');
            $table->string('mail')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
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
