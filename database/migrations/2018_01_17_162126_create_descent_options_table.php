<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescentOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descent_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descent_name', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('descent_options');
    }
	
	/** Init Insert Query
	
		INSERT INTO `descent_options` (`id`, `descent_name`) VALUES
		(1, 'Jackson'),
		(2, 'Green'),
		(3, 'Spouse'),
		(4, 'Friend');
	
	**/
}
