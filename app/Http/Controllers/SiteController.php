<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Routing\Controller;

class SiteController extends Controller {
	public function index() {
		$vehicleModels = Vehicle::all();;

		return view( 'index', [ 'vehicleModels' => $vehicleModels ] );
	}
}
