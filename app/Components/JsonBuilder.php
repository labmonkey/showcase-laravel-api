<?php

namespace App\Components;

/**
 * Class JsonBuilder
 * @package App\Components
 */
class JsonBuilder {
	protected $isSuccess;
	protected $params;

	public function setSuccess() {
		$this->isSuccess = true;
		$this->removeParam( 'message' );
	}

	public function setError( $message ) {
		$this->isSuccess = false;
		$this->setParam( 'message', $message );
	}

	public function setData( $data ) {
		$this->setParam( 'data', $data );
	}

	public function setParam( $key, $value ) {
		// 'success' should be set by using appropriate methods
		if ( ! in_array( $key, [ 'success' ] ) ) {
			$this->params[ $key ] = $value;
		}
	}

	public function removeParam( $key ) {
		if ( isset( $this->params[ $key ] ) ) {
			unset( $this->params[ $key ] );
		}
	}

	/**
	 * Returns a valid JSON array
	 *
	 * @return array
	 */
	public function toArray() {
		$json = [];
		if ( $this->isSuccess === true ) {
			$json['success'] = true;
		} elseif ( $this->isSuccess === false ) {
			$json['success'] = false;
		}

		foreach ( $this->params as $key => $value ) {
			$json[ $key ] = $value;
		}

		return $json;
	}
}