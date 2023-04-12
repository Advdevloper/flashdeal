<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendordetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendordetails', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_firstname')->nullable();
            $table->string('vendor_lastname')->nullable();
            $table->string('vendor_businessname')->nullable();
            $table->string('vendor_email')->unique();
            $table->string('vendor_mobile')->nullable();
            $table->string('vendor_country')->nullable();
            $table->string('vendor_state')->nullable();
            $table->string('vendor_address')->nullable();
            $table->string('vendor_status')->nullable();
            $table->text('vendor_userid')->nullable();
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
        Schema::dropIfExists('vendordetails');
    }
}
