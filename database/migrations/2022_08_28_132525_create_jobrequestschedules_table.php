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
            $table->unsignedBigInteger('last_actionBy');
            $table->foreign('last_actionBy')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')
                    ->references('id')
                    ->on('schedules')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('jobrequest_id');
            $table->foreign('jobrequest_id')
                    ->references('id')
                    ->on('construction_types')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('status')->default(0);
            $table->string('color')->nullable();
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
