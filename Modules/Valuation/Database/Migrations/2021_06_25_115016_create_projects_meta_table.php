<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('projects_meta')) {
            Schema::create('projects_meta', function (Blueprint $table) {
                $table->increments('id');
                $table->string('key', 110);
                $table->text('value')->nullable();
                $table->string('type')->default('string');
                $table->boolean('status')->default(true);
                $table->string('owner_type', 80);
                $table->integer('owner_id');
                $table->unique(['key', 'owner_type', 'owner_id']);
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
        Schema::dropIfExists('projects_meta');
    }
}
