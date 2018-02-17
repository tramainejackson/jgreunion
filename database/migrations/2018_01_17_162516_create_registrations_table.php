<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('family_id')->nullable();
            $table->integer('dl_id')->nullable();
            $table->integer('reunion_id')->nullable();
            $table->char('reunion_complete', 1)->nullable();
            $table->string('registree_name', 100)->nullable();
            $table->string('address', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 2)->nullable();
            $table->string('zip', 5)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('adult_names', 100)->nullable();
            $table->string('youth_names', 100)->nullable();
            $table->string('children_names', 100)->nullable();
            $table->string('shirt_sizes', 100)->nullable();
            $table->string('addt_sizes', 100)->nullable();
            $table->integer('addt_tees')->nullable();
            $table->double('total_amount_due', 15, 2)->nullable();
            $table->double('due_at_reg', 15, 2)->nullable();
            $table->double('total_amount_paid', 15, 2)->nullable();
            $table->date('reg_date')->nullable();
            $table->text('reg_notes')->nullable();
            $table->integer('parent_reg')->nullable();
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
        Schema::dropIfExists('registrations');
    }
}
