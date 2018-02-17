<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommitteeTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committee_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_name', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('committee_titles');
    }
	
	/** Init Insert Query
		INSERT INTO `committee_titles` (`id`, `title_name`) VALUES
		(1, 'president'),
		(2, 'vice_president'),
		(3, 'secretary'),
		(4, 'treasurer'),
		(5, 'correspondence');
	**/
}
