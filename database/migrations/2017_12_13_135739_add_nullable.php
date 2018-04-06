<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('address')->nullable();
            $table->string('street_no')->nullable();
            $table->string('unit')->nullable();
            $table->string('street_name')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->float('price')->nullable();
            $table->string('property_type')->nullable();
            $table->string('sqr_feet')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('partial_bathrooms')->nullable();
            $table->string('leasing_fees')->nullable();
            $table->string('pets')->nullable();
            $table->text('description')->nullable();
            $table->text('lease_terms')->nullable();
            $table->text('notes')->nullable();
            $table->date('schedual_startdate')->nullable();
            $table->date('schedual_enddate')->nullable();
            $table->time('schedual_time')->nullable();
            $table->text('schedual_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            //$table->dropColumn('image');
        });
    }
}
