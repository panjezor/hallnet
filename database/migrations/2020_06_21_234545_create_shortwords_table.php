<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortwordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shortwords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('short_url',10)->unique();
            $table->text('long_url');
            $table->bigInteger('counter');
            $table->boolean('active');
            $table->string('description', 140);
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
        Schema::dropIfExists('shortwords');
    }
}
