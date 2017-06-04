<?php

namespace App\Repositories\Interfaces;

interface ApiQuotaRepositoryInterface {

	public function findCurrentQuotaForKey( $key );
}