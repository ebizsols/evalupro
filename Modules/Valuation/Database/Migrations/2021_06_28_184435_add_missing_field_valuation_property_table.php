<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMissingFieldValuationPropertyTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('valuation_properties'))
        {
            if (!Schema::hasColumn('valuation_properties', 'neighbour_front'))
            {
                Schema::table('valuation_properties', function($table) {
                    $table->string('neighbour_front')->default(null);
                 });
            }  
           if (!Schema::hasColumn('valuation_properties', 'neighbour_back'))
            {
                Schema::table('valuation_properties', function($table) {
                    $table->string('neighbour_back')->default(null);
                 });
            }  
           if (!Schema::hasColumn('valuation_properties', 'left_side'))
            {
                Schema::table('valuation_properties', function($table) {
                    $table->string('left_side')->default(null);
                 });
            }  
           if (!Schema::hasColumn('valuation_properties', 'right_side'))
            {
                Schema::table('valuation_properties', function($table) {
                    $table->string('right_side')->default(null);
                 });
            }  
           if (!Schema::hasColumn('valuation_properties', 'neighbour_adjacent'))
            {
                Schema::table('valuation_properties', function($table) {
                    $table->string('neighbour_adjacent')->default(null);
                 });
            }  
           if (!Schema::hasColumn('valuation_properties', 'municipalityCutting'))
            {
                Schema::table('valuation_properties', function($table) {
                    $table->string('municipalityCutting')->default(null);
                 });
            }  
           if (!Schema::hasColumn('valuation_properties', 'land_structure_type'))
            {
                Schema::table('valuation_properties', function($table) {
                    $table->string('land_structure_type')->default(null);
                 });
            }  
           if (!Schema::hasColumn('valuation_properties', 'depth'))
            {
                Schema::table('valuation_properties', function($table) {
                    $table->string('depth')->default(null);
                 });
            }  
           if (!Schema::hasColumn('valuation_properties', 'description'))
            {
                Schema::table('valuation_properties', function($table) {
                    $table->string('description')->default(null);
                 });
            }  
           if (!Schema::hasColumn('valuation_properties', 'propertyInfo'))
            {
                Schema::table('valuation_properties', function($table) {
                    $table->string('propertyInfo')->default(null);
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
//        Schema::table('valuation_properties', function(Blueprint $table)
//        {
//
//        });
    }

}
