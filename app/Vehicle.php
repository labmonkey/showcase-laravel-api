<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Vehicle extends Model {
	use Eloquence;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'vehicles';

	/*
	 * For eloquence full text search
	 */
	protected $searchableColumns = [
		'manufacturer',
		'model',
		'type',
		'usage',
		'license_plate',
		'weight_category',
		'no_seats',
		'has_boot',
		'has_trailer',
		'owner_name',
		'owner_company',
		'owner_profession',
		'transmission',
		'colour',
		'is_hgv',
		'no_doors',
		'sunroof',
		'has_gps',
		'no_wheels',
		'engine_cc',
		'fuel_type'
	];

	/*
	 * Allows those attributes to be set and saved
	 */
	protected $fillable = [
		'manufacturer',
		'model',
		'type',
		'usage',
		'license_plate',
		'weight_category',
		'no_seats',
		'has_boot',
		'has_trailer',
		'owner_name',
		'owner_company',
		'owner_profession',
		'transmission',
		'colour',
		'is_hgv',
		'no_doors',
		'sunroof',
		'has_gps',
		'no_wheels',
		'engine_cc',
		'fuel_type'
	];
}
