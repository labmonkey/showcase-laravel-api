<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create( 'vehicles', function ( Blueprint $table ) {
		    $table->increments( 'id' );
		    $table->timestamps();
		    // Add ->nullable() ?
		    $table->string( 'manufacturer' );
		    $table->string( 'model' );
		    $table->string( 'type' );
		    $table->string( 'usage' );
		    $table->string( 'license_plate' );
		    $table->integer( 'weight_category' );
		    $table->integer( 'no_seats' );
		    $table->boolean( 'has_boot' )->nullable();
		    $table->boolean( 'has_trailer' );
		    $table->string( 'owner_name' );
		    $table->string( 'owner_company' );
		    $table->string( 'owner_profession' );
		    $table->string( 'transmission' );
		    $table->string( 'colour' );
		    $table->boolean( 'is_hgv' );
		    $table->integer( 'no_doors' );
		    $table->integer( 'sunroof' );
		    $table->boolean( 'has_gps' );
		    $table->integer( 'no_wheels' );
		    $table->integer( 'engine_cc' );
		    $table->string( 'fuel_type' );
	    } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists( 'vehicles' );
    }
}
