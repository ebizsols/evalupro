<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InitialValuesOfScopeOfWork extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scope_of_works', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->integer('client_id')->unsigned()->nullable();;
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('estimate_number')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->date('valid_till')->nullable();
            $table->double('sub_total')->nullable();
            $table->double('total')->nullable();
            $table->string('discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['declined', 'accepted', 'waiting'])->default('waiting');
            $table->boolean('send_status')->default(1);
            $table->mediumText('note')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

        });
        DB::statement("ALTER TABLE `scope_of_works` CHANGE `status` `status` ENUM('declined','accepted','waiting','sent','draft') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'waiting';");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scope_of_works');
    }
}
