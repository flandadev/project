<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_id');
            $table->string('event_token');
            $table->string('email');
            $table->string('value')->unique();
            $table->boolean('expired')->default(false);
            $table->boolean('hasBus');
            $table->string('busType');
            $table->timestamp('expiration');
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
        Schema::dropIfExists('tickets');
    }
}
