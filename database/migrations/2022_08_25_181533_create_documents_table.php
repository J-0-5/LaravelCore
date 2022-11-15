<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('associate_to')->nullable();
            $table->unsignedBigInteger('associate_id')->nullable();
            $table->unsignedBigInteger('document_type')->nullable();
            $table->foreign('document_type')->references('id')->on('parameter_values');
            $table->string('url')->nullable();
            $table->text('description')->nullable();
            $table->json('data')->nullable();
            $table->unsignedBigInteger('creator_user_id')->nullable();
            $table->foreign('creator_user_id')->references('id')->on('users');
            $table->timestamps();
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
        Schema::dropIfExists('documents');
    }
}
