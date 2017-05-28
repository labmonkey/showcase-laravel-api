<?php

namespace App\Http\Middleware;

use App\ApiQuota;
use Closure;

class VerifyApiQuota {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		$quota = ApiQuota::getCurrent( $request->key );

		if ( $quota->quota < $quota->maxQuota ) {
			$quota->quota += 1;
			$quota->save();
		} else {
			$json = [
				'success' => false,
				'message' => 'You have reached your quota limit for today.'
			];

			return response()->json( $json, 200, [], JSON_PRETTY_PRINT );
		}

		return $next( $request );
	}
}
