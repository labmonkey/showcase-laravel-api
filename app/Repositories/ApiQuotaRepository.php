<?php

namespace App\Repositories;

use App\Models\ApiQuota;
use App\Repositories\Interfaces\ApiQuotaRepositoryInterface;
use Illuminate\Support\Facades\Config;

class ApiQuotaRepository extends EloquentRepository implements ApiQuotaRepositoryInterface {

	/**
	 * Set the relevant model instance.
	 *
	 * @param ApiQuota $model
	 */
	public function __construct( ApiQuota $model ) {
		$this->model = $model;
	}

	public function findCurrentQuotaForKey( $apiKey ) {
		if ( ! ( $quota = $this->findWhere( [ [ 'key', '=', $apiKey ], [ 'expires', '>', time() ] ] ) ) ) {
			return $this->create( [
				'key'      => $apiKey,
				'quota'    => 0,
				'maxQuota' => Config::get( 'api.maxQuota' ),
				'expires'  => strtotime( Config::get( 'api.expiration' ) )
			] );
		}

		return $quota;
	}
}