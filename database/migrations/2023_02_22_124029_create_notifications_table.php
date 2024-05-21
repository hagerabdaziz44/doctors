<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sender_id')->unsigned()->nullable();
            $table->bigInteger('receiver_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('content');
            $table->foreign('sender_id')->references('id')->on('userss')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('userss')->onDelete('cascade');
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
        Schema::dropIfExists('notifications');
    }
}
