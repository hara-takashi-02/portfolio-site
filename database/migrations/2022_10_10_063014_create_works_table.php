<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->length(4);
            $table->string('title', 100)->nullable();
            $table->string('content', 500)->nullable();
            $table->text('free_txt')->nullable();
            $table->string('file_path')->nullable();//写真
            $table->string('file_name')->nullable();//写真
            $table->integer('sort')->length(4);
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
        Schema::dropIfExists('works');
    }
}
