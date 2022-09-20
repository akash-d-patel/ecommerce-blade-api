<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimezonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timezones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('abbreviation')->nullable();
            $table->string('offSet')->nullable();
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
        Schema::dropIfExists('timezones');
    }
}
