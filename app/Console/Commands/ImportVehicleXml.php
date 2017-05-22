<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImportVehicleXml extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'vehicles:import {filePath?}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import XML from given file path';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$filePath = $this->argument( 'filePath' );
		if ( ! $filePath ) {
			//$filePath = Storage::disk( 'local' )->url( 'local/VehicleSample.xml' );
			$filePath = Storage::disk( 'local' )->getDriver()->getAdapter()->applyPathPrefix( 'local/VehicleSample.xml' );
		}

		echo "Your file is: \r\n";
		echo $filePath;
		echo "\r\n";

		$contents = File::get( $filePath );

		$result = $this->importXml( $contents );

		echo "File import status is: " . ( $result ? "OK!" : "ERROR" );
		echo "\r\n";
	}

	public function importXml($contents) {

		return false;
	}
}
