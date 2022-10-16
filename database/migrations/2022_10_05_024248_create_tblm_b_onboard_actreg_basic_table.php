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
        Schema::create('tblm_b_onboard_actreg_basic', function (Blueprint $table) {
            $table->id('reg_id');
            $table->integer('registrant_type_id')->nullable(); //TODO: foreignId??
            $table->string('reg_firstname', 50);
            $table->string('reg_middlename', 50)->nullable();
            $table->string('reg_lastname', 50);
            $table->date('reg_birthdate');
            $table->string('reg_civilstatus', 50);
            $table->string('reg_religion', 50);
            $table->string('reg_addr_line1', 100);
            $table->string('reg_addr_line2', 100)->nullable();
            $table->string('reg_addr_towncity', 50);
            $table->string('reg_addr_state', 50);
            $table->integer('reg_country_code');
            $table->string('reg_pro_addr_line1', 100);
            $table->string('reg_pro_addr_line2', 100)->nullable();
            $table->string('reg_pro_addr_towncity', 50);
            $table->string('reg_pro_addr_state', 50);
            $table->string('reg_pro_addr_country', 50);
            $table->timestamp('reg_datecreated')->nullable();
            $table->timestamp('reg_datemodified')->nullable();
            $table->integer('reg_modifiedby_id')->nullable(); //TODO: foreignId??
            $table->foreignId('reg_link_preregid')
                    ->unique()
                    ->constrained('tblm_a_onboard_prereg')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblm_b_onboard_actreg_basic');
    }
};
