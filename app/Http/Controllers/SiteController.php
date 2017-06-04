<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\VehicleRepositoryInterface;
use Illuminate\Routing\Controller;

class SiteController extends Controller {
	/* @var $repository VehicleRepositoryInterface */
	protected $repository;

	public function __construct( VehicleRepositoryInterface $repository ) {
		$this->repository = $repository;
	}

	public function index() {
		$vehicleModels = $this->repository->get();

		return view( 'index', [ 'vehicleModels' => $vehicleModels ] );
	}
}
