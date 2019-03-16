<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('version_id')->nullable();
			$table->foreign('version_id')->references('id')->on('versions')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('parent_id')->nullable();
			$table->string('title');
			$table->string('path')->nullable();
			$table->boolean('status')->default(true)->nullable();
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
        Schema::dropIfExists('folders');
    }
}
