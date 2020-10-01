<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmittedTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_tutorials', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('url')->unique()->index();
            $table->json('tools')->nullable();
            $table->json('filters')->nullable();
            $table->unsignedBigInteger('added_by')->index();
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
        Schema::dropIfExists('submitted_tutorials');
    }
}
