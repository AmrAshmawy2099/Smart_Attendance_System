<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->unique();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->text('certificate')->nullable();
            $table->timestamps();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('SET NULL');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
