<?php

namespace App\Http\Controllers;

use App\ApiKey;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController {

	public function actionIndex( Request $request ) {
		$query = $request->input( 'query' );

		$models = Vehicle::search( $query )->get();

		$json = [
			'success' => true,
			'query'   => $query,
			'data'    => $models
		];

		return response()->json( $json, 200, [], JSON_PRETTY_PRINT );
	}

	public function actionKey() {
		$apiKey      = new ApiKey();
		$apiKey->key = ApiKey::generateKey();
		$apiKey->save();

		$json = [
			'key' => $apiKey->key
		];

		return response()->json( $json, 200, [], JSON_PRETTY_PRINT );
	}

	public function actionPublicIndex() {
		$models = Vehicle::all();
		if ( count( $models ) ) {
			$json = [
				'success' => true,
				'data'    => $models
			];
		} else {
			$json = [
				'success' => false,
				'message' => "Database Error. Maybe it's empty?"
			];
		}

		return response()->json( $json, 200, [], JSON_PRETTY_PRINT );
	}

	public function actionPublicCar( $id = null ) {
		if ( ! $id ) {
			// get random model
			$model = Vehicle::inRandomOrder()->first();
			if ( $model ) {
				$json = [
					'success' => true,
					'data'    => [
						$model
					]
				];
			} else {
				$json = [
					'success' => false,
					'message' => "Database Error. Maybe it's empty?"
				];
			}
		} else {
			// get model by id
			$model = Vehicle::where( [ 'id' => $id ] )->first();
			if ( $model ) {
				$json = [
					'success' => true,
					'data'    => [
						$model
					]
				];
			} else {
				$json = [
					'success' => false,
					'message' => "Vehicle with given ID doesn't exist."
				];
			}
		}

		return response()->json( $json, 200, [], JSON_PRETTY_PRINT );
	}
}
