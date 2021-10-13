<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRefIdInValuationPropertyTable extends Migration
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
           if (!Schema::hasColumn('valuation_properties', 'ref_id'))
            {
                Schema::table('valuation_properties', function($table) {
                    $table->string('ref_id')->default(0);
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
         if (!Schema::hasTable('valuation_properties')) 
         {
            if (!Schema::hasColumn('valuation_properties', 'ref_id'))
            {
            }
         }
       
    }

}
