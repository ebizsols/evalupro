<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormFieldKeyToProjectTemplateSubTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_template_sub_tasks', function (Blueprint $table) {
            $table->string('formFieldKey');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_template_sub_tasks', function (Blueprint $table) {
            $table->dropColumn('formFieldKey');
        });
    }
}
