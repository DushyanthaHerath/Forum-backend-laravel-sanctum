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
        Schema::create('posts', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->string('title');
            $table->text('content');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('posted_by');
            $table->unsignedInteger('approved_by')->nullable();
            $table->enum('status', ['approved', 'pending']);
            $table->foreign('posted_by')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('posts');
    }
};
