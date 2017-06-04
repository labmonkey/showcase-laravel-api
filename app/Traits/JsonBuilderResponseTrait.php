<?php
namespace App\Traits;

trait JsonBuilderResponseTrait {
	protected function jsonResponse( $jsonBuilder ) {
		return response()->json( $jsonBuilder->toArray(), 200, [], JSON_PRETTY_PRINT );
	}
}