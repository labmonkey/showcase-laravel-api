<?php

namespace App\Http\Controllers;

use App\Components\JsonBuilder;
use App\Models\ApiKey;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ApiController extends Controller {

	/**
	 * This action performs full text search on Vehicles to find data based on 'query' string
	 */
	public function actionIndex( Request $request ) {
		$query = $request->input( 'query' );

		$models = Vehicle::search( $query )->get();

		$jsonBuilder = new JsonBuilder();
		$jsonBuilder->setParam( 'query', $query );
		$jsonBuilder->setParam( 'count', count( $models ) );
		$jsonBuilder->setData( $models );

		return $this->jsonResponse( $jsonBuilder );
	}

	public function actionKey() {
		$apiKey = ApiKey::generateModel();

		$jsonBuilder = new JsonBuilder();
		$jsonBuilder->setSuccess();
		$jsonBuilder->setParam( 'key', $apiKey->key );

		return $this->jsonResponse( $jsonBuilder );
	}

	public function actionPublicIndex() {
		$jsonBuilder = new JsonBuilder();
		$models      = Vehicle::all();
		if ( count( $models ) ) {
			$jsonBuilder->setSuccess();
			$jsonBuilder->setData( $models );
		} else {
			$jsonBuilder->setError( "Database Error. Maybe it's empty?" );
		}

		return $this->jsonResponse( $jsonBuilder );
	}

	public function actionPublicCar( $id = null ) {
		$jsonBuilder = new JsonBuilder();
		if ( ! $id ) {
			// get random model
			$model = Vehicle::inRandomOrder()->first();
			if ( $model ) {
				$jsonBuilder->setSuccess();
				$jsonBuilder->setData( $model );
			} else {
				$jsonBuilder->setError( "Database Error. Maybe it's empty?" );
			}
		} else {
			// get model by id
			$model = Vehicle::where( [ 'id' => $id ] )->first();
			if ( $model ) {
				$jsonBuilder->setSuccess();
				$jsonBuilder->setData( $model );
			} else {
				$jsonBuilder->setError( "Vehicle with given ID doesn't exist." );
			}
		}

		return $this->jsonResponse( $jsonBuilder );
	}

	protected function jsonResponse( $jsonBuilder ) {
		return response()->json( $jsonBuilder->toArray(), 200, [], JSON_PRETTY_PRINT );
	}
}
