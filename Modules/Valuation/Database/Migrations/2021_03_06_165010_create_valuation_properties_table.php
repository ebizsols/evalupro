<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuationPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('valuation_properties')) {
            Schema::create('valuation_properties', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedInteger('company_id')->nullable();
                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
                $table->bigInteger('country_id')->default(0);
                $table->bigInteger('governorate_id')->default(0);
                $table->bigInteger('city_id')->default(0);
                $table->bigInteger('block_id')->default(0);
                $table->bigInteger('class_id')->default(0);
                $table->bigInteger('classification_id')->default(0);
                $table->bigInteger('categorization_id')->default(0);
                $table->bigInteger('type_id')->default(0);
                $table->bigInteger('process_status_id')->default(0);
                $table->string('title')->nullable();
                $table->string('locality')->default('');
                $table->string('road')->default(null);
//                $table->string('coordinates')->default(null);
                $table->string('plot_num')->default(null);
                $table->string('land_size')->default(null);
                $table->string('sizes_in_meter_sq')->default(null);
                $table->string('sizes_in_sq_feet')->default(null);

                //Structure info Fields
                $table->string('buildup_sizes')->default(null);
                $table->string('front_elivation')->default(null);
                $table->string('common_area')->default(null);
                $table->string('entrance_num')->default(null);
                $table->string('bldg_num')->default(null);
                $table->string('unit_num')->default(null);
                $table->string('age')->default(null);
                $table->string('status_field')->default(null);
                $table->string('name')->default(null);
                $table->string('role')->default(null);
                $table->string('use')->default(null);
                $table->string('maintenance')->default(null);
                $table->string('no_of_units')->default(null);
                $table->string('no_of_rooms')->default(null);
                $table->string('no_of_roads')->default(null);
                
                //Financial Info Fields
                $table->float('purchase_price')->default(0.00);
                $table->float('land_price')->default(0.00);
                $table->float('construction_price')->default(0.00);
                $table->float('renovation_price')->default(0.00);
                $table->float('rental_income')->default(0.00);
                $table->float('estimated_value')->default(0.00);

                $table->enum('status', array('Active', 'Inactive', 'Draft'))->default('Draft');

                // add there in mata table
                /*$table->string('municipality_cutting');
                $table->string('front');
                $table->string('back');
                $table->string('left_side');
                $table->string('right_side');
                $table->string('adjacent');
                $table->string('surroundings');
                $table->string('views');
                $table->string('accessibility');
                $table->string('description')->default(null);
                $table->string('property_info')->default(null);
                */

                $table->timestamps();
            });
        }

        if (!Schema::hasColumn('valuation_properties', 'latitude'))
        {
            Schema::table('valuation_properties', function($table) {
                $table->string('latitude')->default(0);
             });
        }
        if (!Schema::hasColumn('valuation_properties', 'longitude'))
        {
            Schema::table('valuation_properties', function($table) {
                $table->string('longitude')->default(0);
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
        //Schema::dropIfExists('valuation_properties');
    }
}
