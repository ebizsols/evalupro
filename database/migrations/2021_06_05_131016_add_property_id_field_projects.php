<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPropertyIdFieldProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('projects'))
        {
           if (!Schema::hasColumn('projects', 'property_id'))
            {
                Schema::table('projects', function (Blueprint $table) {
                    $table->unsignedBigInteger('property_id')->nullable();
                    $table->foreign('property_id')->references('id')->on('valuation_properties')->onDelete('cascade')->onUpdate('cascade');

                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['property_id']);
        });
    }
}
