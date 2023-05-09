<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    public function up()
    {
        Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('log_name', 255)->nullable();
            $table->text('description')->nullable();
            $table->text('input_data')->nullable();
            $table->string('code', 20)->nullable();
            $table->string('ip', 100)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('url', 200)->nullable();
            $table->string('method', 100)->nullable();
            $table->string('agent', 255)->nullable();
            $table->timestamps();
            $table->index('log_name');
        });
    }

    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
    }
}
