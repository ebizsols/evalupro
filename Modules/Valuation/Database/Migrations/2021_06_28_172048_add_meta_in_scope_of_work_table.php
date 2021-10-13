<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaInScopeOfWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('scope_of_works')) {
            if (!Schema::hasColumn('scope_of_works', 'meta')) {
                Schema::table('scope_of_works', function (Blueprint $table) {
                    $table->text('meta')->nullable();
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
        Schema::table('scope_of_works', function (Blueprint $table) {
            $table->dropColumn('meta');
        });
    }
}
