<?php

namespace App\Repositories\Interfaces;

interface ApiKeyRepositoryInterface {

	public function keyExists( $key );
}