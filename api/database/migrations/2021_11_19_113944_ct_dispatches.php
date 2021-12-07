<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CtDispatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ct_dispatches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('line');
            $table->string('part');
            $table->integer('dispatch_id');
            $table->integer('dispatch_status');
            $table->string('amg');
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
        //
        Schema::dropIfExists('ct_dispatches');
    }
}
