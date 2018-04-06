<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('address');
            $table->string('street_no');
            $table->string('unit');
            $table->string('street_name');
            $table->string('city');
            $table->string('zipcode');
            $table->float('price');
            $table->string('property_type');
            $table->string('sqr_feet');
            $table->string('bedrooms');
            $table->string('bathrooms');
            $table->string('partial_bathrooms');
            $table->string('leasing_fees');
            $table->string('pets');
            $table->text('description');
            $table->text('lease_terms');
            $table->text('notes');
            $table->date('schedual_startdate');
            $table->date('schedual_enddate');
            $table->time('schedual_time');
            $table->text('schedual_notes');
            $table->enum('status', array('1', '0'))->default(1);
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
        Schema::dropIfExists('listings');
    }
}
