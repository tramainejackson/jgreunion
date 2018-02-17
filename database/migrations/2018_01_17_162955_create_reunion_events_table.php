<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReunionEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reunion_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reunion_id')->nullable();
            $table->string('event_description', 255)->nullable();
            $table->string('event_location', 255)->nullable();
            $table->date('event_date')->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reunion_events');
    }
}
