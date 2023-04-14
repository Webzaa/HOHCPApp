<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapCollateralImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_collateral_image', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_collateral_id')->unsigned();              
            $table->string('path');
            $table->foreign('project_collateral_id')
            ->references('id')->on('project_collateral')->onDelete('cascade');
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
        Schema::dropIfExists('map_collateral_image');
    }
}
