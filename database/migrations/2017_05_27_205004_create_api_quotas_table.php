<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiQuotasTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'api_quotas', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->timestamps();
			$table->string( 'key' );
			$table->timestamp( 'expires' );
			$table->integer( 'quota' );
			$table->integer( 'maxQuota' );

			$table->foreign( 'key' )->references( 'key' )->on( 'api_keys' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'api_quotas' );
	}
}
