<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use XmlParser;

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

		$result = $this->importXml( $filePath );

		echo "File import status is: " . ( $result ? "OK!" : "ERROR" );
		echo "\r\n";
	}

	public function importXml( $filePath ) {
		$xml = XmlParser::load( $filePath );

		$attributes = [
			'::manufacturer',
			'::model',
			'type',
			'usage',
			'license_plate',
			'weight_category',
			'no_seats',
			'has_boot',
			'has_trailer',
			'owner_name',
			'owner_company',
			'owner_profession',
			'transmission',
			'colour',
			'is_hgv',
			'no_doors',
			'sunroof',
			'has_gps',
			'no_wheels',
			'engine_cc',
			'fuel_type'
		];

		$param = implode( ',', $attributes );

		$item = $xml->parse( [
			'Vehicles' => [
				'uses' => "Vehicle[{$param}]"
			]
		] );

		dd( $item );

		return count( $item ) > 0;
	}
}
