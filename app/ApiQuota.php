<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class ApiQuota extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'api_quotas';

	/*
	 * Allows those attributes to be set and saved
	 */
	protected $fillable = [
		'key',
		'expires',
		'quota',
		'maxQuota'
	];

	/**
	 * Returns quota model if there is one that did not expire or creates a new one.
	 *
	 * @param $apiKey
	 *
	 * @return static
	 */
	public static function getCurrent( $apiKey ) {
		if ( ! ( $quota = ApiQuota::where( [ [ 'key', '=', $apiKey ], [ 'expires', '>', time() ] ] )->first() ) ) {
			$quota           = new static();
			$quota->key      = $apiKey;
			$quota->quota    = 0;
			$quota->maxQuota = Config::get( 'api.maxQuota' );
			$quota->expires  = strtotime( Config::get( 'api.expiration' ) );
			$quota->save();
		}

		return $quota;
	}
}
