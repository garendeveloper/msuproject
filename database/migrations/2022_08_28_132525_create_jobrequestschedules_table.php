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
        Schema::create('jobrequestschedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->default(0);
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')
                    ->references('id')
                    ->on('schedules')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('jobrequestschedules');
    }
};
