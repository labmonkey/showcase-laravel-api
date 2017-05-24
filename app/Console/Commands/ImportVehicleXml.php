<?php

namespace App\Console\Commands;

use App\Vehicle;
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

	protected $updatedCount = 0;

	protected $insertedCount = 0;

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

		$this->info( "Your file is:" );
		$this->info( $filePath );

		$result = $this->importXml( $filePath );

		$this->info( "File import status is: " . ( $result ? "OK!" : "ERROR" ) );

		return 1;
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

		$items = $xml->parse( [
			'Vehicles' => [
				'uses' => "Vehicle[{$param}]"
			]
		] );

		if ( isset( $items ['Vehicles'] ) ) {
			$this->saveVehicleData( $items['Vehicles'] );

			return $this->updatedCount + $this->insertedCount > 0;
		}

		return false;
	}

	public function saveVehicleData( $data ) {
		foreach ( $data as $item ) {
			$store  = Vehicle::firstOrNew( [ 'license_plate' => $item['license_plate'] ] );
			$exists = $store->exists;

			$item = $this->fixKeys( $item );

			$store->fill( $item );
			$store->save();
			if ( $exists ) {
				$this->updatedCount ++;
			} else {
				$this->insertedCount ++;
			}
		}

		$this->info( "Updated: " . $this->updatedCount );
		$this->info( "Inserted: " . $this->insertedCount );
	}

	function fixKeys( $array ) {
		$keys = array_keys( $array );
		array_walk( $keys, [ $this, 'removePrefix' ], '::' );

		return array_combine( $keys, $array );
	}

	function removePrefix( &$value, $omit, $prefix ) {
		$value = str_replace( $prefix, '', $value );
	}
}
