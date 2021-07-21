<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->unique();
            $table->enum('type', ['Smart Card','Mobile', 'Normal Card']);
            $table->boolean('valid');
            $table->string('user_code');
            $table->text('certificate')->nullable();
            $table->timestamps();
            $table->foreign('user_code')->references('code')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('cards', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
