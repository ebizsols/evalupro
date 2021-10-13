<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductIdFieldProjects extends Migration
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
           if (!Schema::hasColumn('projects', 'product_id'))
            {
                Schema::table('projects', function (Blueprint $table) {
                    $table->unsignedInteger('product_id')->nullable();
                    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

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
            $table->dropColumn(['product_id']);
        });
    }
}
