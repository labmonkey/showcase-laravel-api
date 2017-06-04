<?php

namespace Tests\Feature;

use App\Models\ApiKey;
use Tests\TestCase;

class AuthApiTest extends TestCase {

	public function testEndpointStatus() {
		$response = $this->get( '/' );
		$response->assertStatus( 200 );

		$response = $this->get( '/api/key' );
		$response->assertStatus( 200 );

		$response = $this->get( '/api' );
		$response->assertStatus( 405 );

		$response = $this->post( '/api' );
		$response->assertStatus( 200 );
	}

	public function testKeyRequest() {
		$response = $this->json( 'GET', '/api/key' );

		$response
			->assertStatus( 200 )
			->assertJson( [
				'key' => true,
			] );
	}

	public function testValidQueryRequest() {
		$model = ApiKey::generateModel();

		$response = $this->json( 'POST', '/api',
			[ 'key' => $model->key, 'query' => 'Citroen' ]
		);

		$response
			->assertStatus( 200 )
			->assertJson( [
				'data' => true,
			] );
	}

	public function testInvalidQueryRequest() {
		$response = $this->json( 'POST', '/api',
			[ 'key' => null, 'query' => 'Citroen' ]
		);

		$response
			->assertStatus( 200 )
			->assertJsonFragment( [
				'success' => false,
			] )->assertJson( [
				'message' => true
			] );
	}
}
