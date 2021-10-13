<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuationPropertyWeightagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('valuation_property_weightages')) {
            Schema::create('valuation_property_weightages', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('company_id')->nullable();
                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
                $table->unsignedInteger('category_id')->nullable();
                $table->foreign('category_id')->references('id')->on('valuation_property_weightage_categories')->onDelete('cascade')->onUpdate('cascade');
                $table->string('title')->default(null);
                $table->string('value')->default(null);
                $table->enum('status', array('Active', 'Inactive'));
                $table->timestamps();
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
        Schema::drop('valuation_property_weightages');
    }

}
