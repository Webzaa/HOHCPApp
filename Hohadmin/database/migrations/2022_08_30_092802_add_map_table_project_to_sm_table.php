<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMapTableProjectToSmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('map_project_sm', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sm_id')->unsigned(); 
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('sm_id')
            ->references('id')->on('sales_manager')->onDelete('cascade');
            $table->foreign('project_id')
            ->references('id')->on('project')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map_project_sm');
    }
}
