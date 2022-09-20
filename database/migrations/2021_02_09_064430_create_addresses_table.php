<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->bigInteger('mobile_no');
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('landmark')->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('state_id')->nullable()->constrained('states')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->constrained('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('pin_code');
            $table->string('address_type');
            $table->string('status')->default('Active')->index();

            // user and time
            $table->timestamp('created_at')->useCurrent();
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('deleted_at')->nullable();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullable()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
