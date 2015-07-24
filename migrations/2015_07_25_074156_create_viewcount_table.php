<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewcountTable extends Migration
{
    public function up()
    {
        Schema::create('viewcount', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->index();
            $table->string('ip', 45)->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('viewcount');
    }
}
