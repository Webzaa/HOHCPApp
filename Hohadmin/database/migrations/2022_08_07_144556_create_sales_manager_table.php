<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_manager', function (Blueprint $table) {
            $table->id();
            $table->string('sm_name');
            $table->string('email_id');
            $table->string('mobile');
            $table->string('address');
            $table->string('vendor_id');
            $table->string('company_name');
            $table->string('gst_no');
            $table->string('acc_no');
            $table->string('ifsc');
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
        Schema::dropIfExists('sales_manager');
    }
}
