<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('name', 128);
            $table->string('description',512)->nullable();
            $table->unsignedBigInteger('parent_id')->default(null)->nullable();
            $table->string('picture')->default('genre.png');
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
//        Schema::table('genres', function (Blueprint $table) {
//            //
//        });
        Schema::dropIfExists('genres');
    }
}
