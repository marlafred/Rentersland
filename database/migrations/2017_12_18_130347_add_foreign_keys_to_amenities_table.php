<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAmenitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('amenities', function(Blueprint $table)
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
		Schema::table('amenities', function(Blueprint $table)
		{
			$table->dropForeign('amenities_listing_id_foreign');
		});
	}

}
