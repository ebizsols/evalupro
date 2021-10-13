<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuationSowRules extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('valuation_sow_rules'))
        {
            Schema::create('valuation_sow_rules', function(Blueprint $table)
            {
                $table->increments('id');
                $table->unsignedInteger('company_id')->nullable();
                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
                $table->enum('rule_type', array('ValuatorsLimitations', 'InformationOfSources', 'TypeOfReport','RestrictionsOnDistribution','ValuationReport'))->default('ValuatorsLimitations');
                $table->longText('description')->nullable();
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
//        Schema::dropIfExists('valuation_sow_rules');
    }

}
