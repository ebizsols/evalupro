<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTemplateMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_template_milestones', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('project_template_id')->unsigned()->nullable();
            $table->foreign('project_template_id')->references('id')->on('project_templates')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('currency_id')->unsigned()->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');

            $table->string('milestone_title');
            $table->mediumText('summary');
            $table->float('cost');
            $table->enum('status', ['complete', 'incomplete'])->default('incomplete');
            $table->boolean('invoice_created');
            $table->integer('invoice_id')->nullable();
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
        Schema::dropIfExists('project_milestones');
    }
}
