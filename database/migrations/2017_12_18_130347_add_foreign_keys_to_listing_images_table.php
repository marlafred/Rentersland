<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToListingImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('listing_images', function(Blueprint $table)
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
		Schema::table('listing_images', function(Blueprint $table)
		{
			$table->dropForeign('listing_images_listing_id_foreign');
		});
	}

}
