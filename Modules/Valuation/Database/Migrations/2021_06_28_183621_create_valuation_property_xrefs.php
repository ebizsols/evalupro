<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuationPropertyXrefs extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('valuation_property_xrefs'))
        {
            Schema::create('valuation_property_xrefs', function(Blueprint $table)
            {
                $table->increments('id');
                $table->bigInteger('property_id')->default(null);
                $table->bigInteger('unit_id')->default(0);
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::drop('valuation_property_xrefs');
    }

}
