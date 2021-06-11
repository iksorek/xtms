<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('vehicle_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->string('postcode_from');
            $table->string('postcode_to');
            $table->integer('distance')->nullable();
            $table->timestamp('start_time');
            $table->timestamp('finish_est')->nullable();
            $table->timestamp('back_est')->nullable();
            $table->timestamp('finished')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('paid')->default(false);
            $table->text('additional_info')->nullable();
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
        Schema::dropIfExists('runs');
    }
}
