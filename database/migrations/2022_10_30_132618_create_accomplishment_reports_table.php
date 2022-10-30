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
        Schema::create('accomplishment_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jobrequest_id');
            $table->foreign('jobrequest_id')
                    ->references('id')
                    ->on('jobrequestschedules')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('gaa');
            $table->double('amount_utilized')->default('0.0');
            $table->string('remarks');
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
        Schema::dropIfExists('accomplishment_reports');
    }
};
