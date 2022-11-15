<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->boolean('editable')->default(1)->comment("{0:False;1:True}");
            $table->integer('active')->default(1)->comment("{0:Inactive;1:Active}");
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
        Schema::dropIfExists('parameters');
    }
}
