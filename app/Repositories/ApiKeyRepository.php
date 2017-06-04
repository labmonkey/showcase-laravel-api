<?php

namespace App\Repositories;

use App\Models\ApiKey;
use App\Repositories\Interfaces\ApiKeyRepositoryInterface;

class ApiKeyRepository extends EloquentRepository implements ApiKeyRepositoryInterface {

	/**
	 * Set the relevant model instance.
	 *
	 * @param ApiKey $model
	 */
	public function __construct( ApiKey $model ) {
		$this->model = $model;
	}

	public function keyExists( $key ) {
		return $this->findBy( 'key', $key ) !== null;
	}
}