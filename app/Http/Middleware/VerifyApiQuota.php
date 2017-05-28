<?php

namespace App\Http\Middleware;

use App\ApiQuota;
use Closure;
use Illuminate\Support\Facades\Config;

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
		if ( $quota = ApiQuota::where( [ [ 'key', '=', $request->key ], [ 'expires', '>', time() ] ] )->first() ) {
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
		} else {
			$quota           = new ApiQuota();
			$quota->key      = $request->key;
			$quota->quota    = 1;
			$quota->maxQuota = Config::get( 'api.maxQuota' );
			$quota->expires  = strtotime( Config::get( 'api.expiration' ) );
			$quota->save();
		}

		return $next( $request );
	}
}
