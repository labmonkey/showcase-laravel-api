<?php

namespace App\Http\Middleware;

use App\Components\JsonBuilder;
use App\Repositories\Interfaces\ApiKeyRepositoryInterface;
use App\Traits\JsonBuilderResponseTrait;
use Closure;

class VerifyApiKey {
	use JsonBuilderResponseTrait;

	/* @var $repository ApiKeyRepositoryInterface */
	protected $repository;

	public function __construct( ApiKeyRepositoryInterface $repository ) {
		$this->repository = $repository;
	}

	/**
	 * Check if provided key is valid and exists.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		if ( ! $request->has( 'key' ) || ! $this->repository->keyExists( $request->key ) ) {

			$jsonBuilder = new JsonBuilder();
			$jsonBuilder->setError( 'Wrong API key.' );

			return $this->jsonResponse( $jsonBuilder );
		}

		return $next( $request );
	}
}
