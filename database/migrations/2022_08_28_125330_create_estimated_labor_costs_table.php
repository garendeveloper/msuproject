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
        Schema::create('estimated_labor_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('construction_id');
            $table->foreign('construction_id')
                    ->references('id')
                    ->on('constructions')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('manpower');
            $table->integer('no_ofpersons');
            $table->integer('no_ofheaddays');
            $table->integer('no_mandays');
            $table->integer('daily_rate');
            $table->double('amount');
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
        Schema::dropIfExists('estimated_labor_costs');
    }
};
