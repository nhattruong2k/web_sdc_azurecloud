<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->integer('course_category_id')->unsigned()->index();
            $table->foreign('course_category_id')->references('id')->on('course_categories')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->text('content');
            $table->string('description', 1000)->nullable();
            $table->boolean('status')->default(0);
            $table->string('time');
            $table->string('degree');
            $table->string('object');
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
		Schema::drop('courses');
	}
};
