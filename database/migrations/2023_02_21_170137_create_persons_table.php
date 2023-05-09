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
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname', 100);
            $table->string('avatar')->nullable();
            $table->string('profession',45)->nullable();
            $table->string('position',45)->nullable();
            $table->string('workplace',45)->nullable();
            $table->boolean('role')->comment('0:teacher, 1:student');
            $table->string('skills', 250)->nullable();
            $table->string('description')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('persons');
    }
};
