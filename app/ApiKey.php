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

	/**
	 * Generates random and unique API key.
	 *
	 * @return string
	 */
	public static function generateKey() {
		return md5( uniqid( rand(), true ) );
	}

	public static function generateModel() {
		$apiKey      = new ApiKey();
		$apiKey->key = ApiKey::generateKey();
		$apiKey->save();

		return $apiKey;
	}
}
