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
        Schema::create('approved_job_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('constructiontype_id');
            $table->foreign('constructiontype_id')
                    ->on('construction_types')
                    ->references('id')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('last_actionBy');
            $table->foreign('last_actionBy')
                    ->on('users')
                    ->references('id')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('approved_job_requests');
    }
};
