<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelPartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_partner', function (Blueprint $table) {
            $table->id();
            $table->string('cp_name');
            $table->string('email_id');
            $table->bigInteger('mobile');
            $table->string('address');
            $table->string('departments');
            $table->string('projects');
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
        Schema::dropIfExists('channel_partner');
    }
}
