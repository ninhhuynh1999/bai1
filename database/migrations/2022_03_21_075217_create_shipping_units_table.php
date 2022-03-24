<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_units', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->unique();
            $table->string('shortName')->unique();
            $table->string('phoneNumber')->nullable();
            $table->string('taxId')->nullable();
            $table->unsignedInteger('status_id')->default(1);
            $table->date('dateStopContact')->nullable();

            $table->string('bankName')->nullable();
            $table->string('bankNumber')->nullable();
            $table->string('bankAddress')->nullable();

            $table->string('address')->nullable();
            $table->text('contact')->nullable();
            $table->text('note')->nullable();

            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('status_shipping_units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_units');
    }
}
