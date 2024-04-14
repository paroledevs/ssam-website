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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('method')->nullable();
            $table->string('ip')->nullable();
            $table->string('agent')->nullable();
            $table->string('action')->nullable();
            $table->unsignedBigInteger('performed_on_model')->nullable();
            $table->string('performed_on_class')->nullable();
            $table->longText('payload')->nullable()->fulltext();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
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
        Schema::dropIfExists('activities');
    }
};
