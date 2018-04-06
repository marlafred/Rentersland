<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBuildingAmentiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('building_amenties', function(Blueprint $table)
		{
			$table->foreign('listing_id')->references('id')->on('listings')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('building_amenties', function(Blueprint $table)
		{
			$table->dropForeign('building_amenties_listing_id_foreign');
		});
	}

}
