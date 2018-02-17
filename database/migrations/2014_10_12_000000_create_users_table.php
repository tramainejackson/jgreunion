<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 100)->nullable();
            $table->string('username', 100)->nullable();
            $table->string('firstname', 20)->nullable();
            $table->string('lastname', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 2)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('phone', 15)->nullable();
            $table->text('notes')->nullable();
            $table->string('descent', 10)->nullable();
            $table->integer('spouse')->nullable();
            $table->integer('mother')->nullable();
            $table->integer('father')->nullable();
            $table->integer('spouse')->nullable();
            $table->integer('sibling')->nullable();
            $table->integer('children')->nullable();
            $table->string('instagram', 100)->nullable();
            $table->string('facebook', 100)->nullable();
            $table->string('twitter', 100)->nullable();
            $table->string('photo', 100)->nullable();
            $table->char('show_contact', 1)->nullable();
            $table->char('show_social', 1)->nullable();
            $table->char('administrator', 1)->nullable();
            $table->char('editable', 1)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
