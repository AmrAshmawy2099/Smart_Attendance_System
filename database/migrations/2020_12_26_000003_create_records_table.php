<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('user_code');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('machine_id');
            $table->unsignedBigInteger('card_id');
            $table->text('body')->nullable();
            $table->enum('uploaded_by', ['Machine','Admin App', 'Student App']);
            $table->timestamps();
            $table->foreign('user_code')->references('code')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');
            $table->unique(['user_code', 'room_id', 'card_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
