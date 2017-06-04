<?php

namespace App\Http\Controllers;

use App\Components\JsonBuilder;
use App\Models\ApiKey;
use App\Repositories\Interfaces\VehicleRepositoryInterface;
use App\Traits\JsonBuilderResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ApiController extends Controller {
	use JsonBuilderResponseTrait;

	/* @var $repository VehicleRepositoryInterface */
	protected $repository;

	public function __construct( VehicleRepositoryInterface $repository ) {
		$this->repository = $repository;
	}

	/**
	 * This action performs full text search on Vehicles to find data based on 'query' string
	 */
	public function actionIndex( Request $request ) {
		$query = $request->input( 'query' );

		$models = $this->repository->fullTextSearch( $query );

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
		$models      = $this->repository->get();

		if ( $models->count() ) {
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
			$model = $this->repository->findRandom();
			if ( $model ) {
				$jsonBuilder->setSuccess();
				$jsonBuilder->setData( $model );
			} else {
				$jsonBuilder->setError( "Database Error. Maybe it's empty?" );
			}
		} else {
			$model = $this->repository->find( $id );
			if ( $model ) {
				$jsonBuilder->setSuccess();
				$jsonBuilder->setData( $model );
			} else {
				$jsonBuilder->setError( "Vehicle with given ID doesn't exist." );
			}
		}

		return $this->jsonResponse( $jsonBuilder );
	}
}
