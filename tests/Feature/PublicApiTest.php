<?php

namespace Tests\Feature;

use App\Models\Vehicle;
use Tests\TestCase;

class PublicApiTest extends TestCase {

	public function testEndpointStatus() {
		$response = $this->get( '/' );
		$response->assertStatus( 200 );

		$response = $this->get( '/public' );
		$response->assertStatus( 404 );

		$response = $this->get( '/public/api' );
		$response->assertStatus( 200 );

		$response = $this->get( '/public/api/car' );
		$response->assertStatus( 200 );

		$response = $this->get( '/public/api/car/5' );
		$response->assertStatus( 200 );
	}
}
