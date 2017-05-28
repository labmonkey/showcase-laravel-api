<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'api_keys';

	/*
	 * Allows those attributes to be set and saved
	 */
	protected $fillable = [
		'key',
	];

	public static function generateKey() {
		return md5( uniqid( rand(), true ) );
	}
}
