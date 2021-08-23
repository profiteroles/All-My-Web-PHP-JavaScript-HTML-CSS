<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name',128);
            $table->string('picture',128)->default('artist.png');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('artists');
    }

}

