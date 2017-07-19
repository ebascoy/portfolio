<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->increments('id');
            // twitter char limit - tweet text (not including poll name - url - space for a 6 digit poll_id
            // this way the poll title won't have to be truncated when shared on twitter
            $table->string('name', (140 -
                strlen('|Polls by Bascoy') -
                strlen('http://www.elybascoy.com/polls/') - 6));
            $table->integer('user_id');
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
        Schema::dropIfExists('polls');
    }
}
