<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildingAmentiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('building_amenties', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('listing_id')->unsigned()->index('building_amenties_listing_id_foreign');
			$table->string('name', 191)->nullable();
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
		Schema::drop('building_amenties');
	}

}
