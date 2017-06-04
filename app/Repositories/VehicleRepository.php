<?php

namespace App\Repositories;

use App\Models\Vehicle;
use App\Repositories\Interfaces\VehicleRepositoryInterface;

class VehicleRepository extends EloquentRepository implements VehicleRepositoryInterface {
	/**
	 * Set the relevant model instance.
	 *
	 * @param Vehicle $model
	 */
	public function __construct( Vehicle $model ) {
		$this->model = $model;
	}
}