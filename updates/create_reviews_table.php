<?php namespace Eugene3993\Reviews\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('eugene3993_reviews_list', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('contacts');
            $table->string('rating');
            $table->text('text');
            $table->boolean('unread')->nullable();
            $table->boolean('publish')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eugene3993_reviews_list');
    }
}
