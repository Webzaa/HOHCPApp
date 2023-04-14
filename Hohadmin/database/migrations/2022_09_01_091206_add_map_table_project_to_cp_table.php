<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMapTableProjectToCpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_project_cp', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cp_id')->unsigned(); 
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('cp_id')
            ->references('id')->on('channel_partner')->onDelete('cascade');
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
        Schema::dropIfExists('map_project_cp');
    }
}
