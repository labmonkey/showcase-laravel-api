<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;

class ApiController extends Controller {

	public function actionIndex( Request $request ) {
	}

	public function actionKey() {
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
