<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReunionCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reunion_committees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dl_id')->nullable();
            $table->integer('reunion_id')->nullable();
            $table->string('member_name', 50)->nullable();
            $table->string('member_title', 50)->nullable();
            $table->string('member_email', 100)->nullable();
            $table->string('member_phone', 15)->nullable();
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
        Schema::dropIfExists('reunion_committees');
    }
}
