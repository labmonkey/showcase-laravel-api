<?php

namespace App\Http\Middleware;

use App\Components\JsonBuilder;
use App\Repositories\Interfaces\ApiQuotaRepositoryInterface;
use App\Traits\JsonBuilderResponseTrait;
use Closure;

class VerifyApiQuota {
	use JsonBuilderResponseTrait;

	/* @var $repository ApiQuotaRepositoryInterface */
	protected $repository;

	public function __construct( ApiQuotaRepositoryInterface $repository ) {
		$this->repository = $repository;
	}

	/**
	 * Check if provided key reached quota limit and deny access or increase quota counter.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		$quota = $this->repository->findCurrentQuotaForKey( $request->key );

		if ( $quota->quota < $quota->maxQuota ) {
			$quota->quota += 1;
			$quota->save();
		} else {
			$jsonBuilder = new JsonBuilder();
			$jsonBuilder->setError( 'You have reached your quota limit for today.' );

			return $this->jsonResponse( $jsonBuilder );
		}

		return $next( $request );
	}
}
