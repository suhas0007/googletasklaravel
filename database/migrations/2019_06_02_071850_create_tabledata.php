<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabledata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabledata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('head_id');
            $table->foreign('head_id')
            ->references('id')->on('tablehead')
            ->onDelete('cascade');
            $table->string('values');
            $table->integer('row_id');
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
        Schema::dropIfExists('tabledata');
    }
}
