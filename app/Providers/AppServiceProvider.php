<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->bind( \App\Repositories\Interfaces\VehicleRepositoryInterface::class, \App\Repositories\VehicleRepository::class );
		$this->app->bind( \App\Repositories\Interfaces\ApiQuotaRepositoryInterface::class, \App\Repositories\ApiQuotaRepository::class );
		$this->app->bind( \App\Repositories\Interfaces\ApiKeyRepositoryInterface::class, \App\Repositories\ApiKeyRepository::class );
	}
}
