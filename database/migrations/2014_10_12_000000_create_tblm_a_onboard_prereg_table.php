<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblm_a_onboard_prereg', function (Blueprint $table) {
            $table->id('id');
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 150);
            $table->string('email_passwd_conf', 150)->nullable();
            $table->string('ip_addr', 45)->nullable();
            $table->timestamp('date_submitted')->nullable();
            $table->tinyInteger('is_verified')->nullable();
            $table->timestamp('date_verified')->nullable();
            $table->integer('maxdays_rule_id')->nullable(); //TODO: foreignId??
            $table->integer('maxdays_unverified')->nullable();
            $table->tinyInteger('is_expired')->nullable();
            $table->timestamp('date_expired')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblm_a_onboard_prereg');
    }
};
