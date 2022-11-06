<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historys', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->string('content', 500)->nullable();
            $table->text('age_st')->nullable();
            $table->text('age_ed')->nullable();
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
        Schema::dropIfExists('historys');
    }
}
