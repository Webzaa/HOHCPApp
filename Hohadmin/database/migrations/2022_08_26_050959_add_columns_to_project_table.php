<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project', function (Blueprint $table) {
            $table->string('carpet_area')->default('');
            $table->string('connectivity')->default('');
            $table->string('no_of_towers')->default('');
            $table->string('no_of_units')->default('');
            $table->date('possession_date');
            $table->string('rera_certificate_no')->default('');
            $table->string('project_offers')->default('');
            $table->string('rera_certificate_path')->default('');
            $table->string('hero_image_path')->default('');
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
            $table->dropColumn('carpet_area');
            $table->dropColumn('connectivity');
            $table->dropColumn('no_of_towers');
            $table->dropColumn('no_of_units');
            $table->dropColumn('possession_date');
            $table->dropColumn('rera_certificate_no');
            $table->dropColumn('project_offers');
            $table->dropColumn('rera_certificate_path');
            $table->dropColumn('hero_image_path');
        });
    }
}
