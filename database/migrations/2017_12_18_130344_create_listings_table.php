<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateListingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('listings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->enum('status', array('1','0'))->default('1');
			$table->timestamps();
			$table->string('title', 191)->nullable();
			$table->string('address', 191)->nullable();
			$table->string('street_no', 191)->nullable();
			$table->string('unit', 191)->nullable();
			$table->string('street_name', 191)->nullable();
			$table->string('city', 191)->nullable();
			$table->string('zipcode', 191)->nullable();
			$table->float('price')->nullable();
			$table->string('property_type', 191)->nullable();
			$table->string('sqr_feet', 191)->nullable();
			$table->string('bedrooms', 191)->nullable();
			$table->string('bathrooms', 191)->nullable();
			$table->string('partial_bathrooms', 191)->nullable();
			$table->string('leasing_fees', 191)->nullable();
			$table->string('pets', 191)->nullable();
			$table->text('description', 65535)->nullable();
			$table->text('lease_terms', 65535)->nullable();
			$table->text('notes', 65535)->nullable();
			$table->date('schedual_startdate')->nullable();
			$table->date('schedual_enddate')->nullable();
			$table->time('schedual_time')->nullable();
			$table->text('schedual_notes', 65535)->nullable();
			$table->string('slug')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('listings');
	}

}
