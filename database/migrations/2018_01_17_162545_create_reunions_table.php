<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReunionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reunions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reunion_city', 30)->nullable();
            $table->string('reunion_state', 2)->nullable();
            $table->char('has_site', 1)->nullable();
            $table->char('reunion_complete', 1)->nullable();
            $table->double('adult_price', 15, 2)->nullable();
            $table->double('youth_price', 15, 2)->nullable();
            $table->double('child_price', 15, 2)->nullable();
            $table->double('addt_tee_price', 15, 2)->nullable();
            $table->string('picture', 100)->nullable();
            $table->string('registration_form', 100)->nullable();
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
        Schema::dropIfExists('reunions');
    }
}
