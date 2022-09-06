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
        Schema::create('constructions', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('constructiontype_id');
            $table->foreign('constructiontype_id')
                    ->references('id')
                    ->on('construction_types')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('construction_name');
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
        Schema::dropIfExists('constructions');
    }
};
