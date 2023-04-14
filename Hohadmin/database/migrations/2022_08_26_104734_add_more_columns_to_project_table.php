<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnsToProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project', function (Blueprint $table) {
           
            $table->string('amenities_id'); 
            $table->bigInteger('project_type_id')->unsigned()->default('1');
            $table->foreign('project_type_id')
            ->references('id')->on('project_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project', function (Blueprint $table) {
            $table->dropColumn('project_type_id');
            $table->dropColumn('amenities_id');
        });
    }
}
