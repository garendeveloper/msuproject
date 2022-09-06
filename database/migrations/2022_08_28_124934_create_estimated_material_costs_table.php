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
        Schema::create('estimated_material_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('construction_id');
            $table->foreign('construction_id')
                    ->references('id')
                    ->on('constructions')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->char('alphabethical');
            $table->integer('quantity');
            $table->string('unit');
            $table->string('description');
            $table->double('unitcost');
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
        Schema::dropIfExists('estimated_material_costs');
    }
};
