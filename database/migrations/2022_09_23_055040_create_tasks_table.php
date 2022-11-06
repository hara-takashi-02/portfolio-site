<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            #$table->id();
            #$table->timestamps();
            $table->id();
            $table->string('title', 100)->nullable();
            $table->string('content', 100)->nullable();
            $table->string('person_in_charge', 100)->nullable();
            $table->string('file_path')->nullable();//写真
            $table->string('file_name')->nullable();//写真
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
        Schema::dropIfExists('tasks');
    }
}
