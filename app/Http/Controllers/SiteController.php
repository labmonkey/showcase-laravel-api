<?php

namespace App\Http\Controllers;

use App\Vehicle;

class SiteController extends Controller {
	public function index() {
		$vehicleModels = Vehicle::all();;

		return view( 'index', [ 'vehicleModels' => $vehicleModels ] );
	}
}
