<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->string('id')->unique()->primary();
            $table->foreignUuid('user_id');
            $table->string('type')->default('VAN');
            $table->string('make')->default('Mercedes');
            $table->string('model')->default('Sprinter');
            $table->date('mot')->nullable();
            $table->date('tax')->nullable();
            $table->date('insurance')->nullable();
            $table->integer('service')->nullable();
            $table->integer('service_interval')->default(6000);
            $table->string('reg');
            $table->integer('mileage')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
