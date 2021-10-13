<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuationPropertyFeaturesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('valuation_property_features'))
        {
            Schema::create('valuation_property_features', function(Blueprint $table)
            {
                $table->increments('id');
                $table->unsignedInteger('company_id')->nullable();
                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
                $table->unsignedInteger('category_id')->nullable();
                $table->foreign('category_id')->references('id')->on('valuation_property_feature_categories')->onDelete('cascade')->onUpdate('cascade');
                 $table->string('feature_name')->default(null);
                 $table->string('field_type')->default(null);
                 $table->string('sub_fields')->default(null);
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
        Schema::drop('valuation_property_features');
    }

}
