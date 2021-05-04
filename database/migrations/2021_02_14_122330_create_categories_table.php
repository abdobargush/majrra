<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('slug')->unique();
			$table->string('thumbnail')->nullable();
			$table->timestamps();
		});

		Schema::create('category_resource', function (Blueprint $table) {
			$table->unsignedBigInteger('category_id');
			$table->unsignedBigInteger('resource_id');
			$table->string('resource_type');

			$table->primary(['resource_id', 'resource_type']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('categories');
		Schema::dropIfExists('category_resource');
	}
}
