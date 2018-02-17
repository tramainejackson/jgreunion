<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state_name', 15);
            $table->string('state_abb', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
	
	/**
	
		INSERT INTO `years` (`year_id`, `year_num`) VALUES
		(1, '2016'),
		(2, '2018'),
		(3, '2019'),
		(4, '2020'),
		(5, '2021'),
		(6, '2022'),
		(7, '2023'),
		(8, '2024'),
		(9, '2025'),
		(10, '2026'),
		(11, '2027'),
		(12, '2028'),
		(13, '2029'),
		(14, '2030'),
		(15, '2031'),
		(16, '2032');
		
	**/
}
