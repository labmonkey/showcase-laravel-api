<?php

namespace App\Http\Middleware;

use App\ApiKey;
use Closure;

class VerifyApiKey {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		if ( ! $request->has( 'key' ) || ! ApiKey::where( [ [ 'key', '=', $request->key ] ] )->first() ) {
			$json = [
				'success' => false,
				'message' => 'Wrong API key.'
			];

			return response()->json( $json, 200, [], JSON_PRETTY_PRINT );
		}

		return $next( $request );
	}
}
