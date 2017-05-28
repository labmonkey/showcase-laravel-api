<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
