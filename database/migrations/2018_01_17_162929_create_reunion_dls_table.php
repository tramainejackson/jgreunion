<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReunionDlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reunion_dls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('family_id')->nullable();
            $table->string('firstname', 20)->nullable();
            $table->string('lastname', 20)->nullable();
            $table->string('address', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 2)->nullable();
            $table->string('zip', 5)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('notes')->nullable();
            $table->string('descent', 10)->nullable();
            $table->integer('mother')->nullable();
            $table->integer('father')->nullable();
            $table->integer('spouse')->nullable();
            $table->integer('sibling')->nullable();
            $table->integer('child')->nullable();
            $table->string('age_group', 15)->nullable();
            $table->char('mail_preference', 1)->nullable();
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
        Schema::dropIfExists('reunion_dls');
    }
}
