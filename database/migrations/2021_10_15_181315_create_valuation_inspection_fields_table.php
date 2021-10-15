<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuationInspectionFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuation_inspection_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('valuation_inspection_id')->nullable();
            $table->foreign('valuation_inspection_id')->references('id')->on('valuation_inspections')->onDelete('cascade')->onUpdate('cascade');
            $table->string('field_title')->default(null);
            $table->string('field_value')->default(null);
            $table->string('field_data')->default(null);
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
        Schema::dropIfExists('valuation_inspection_fields');
    }
}
