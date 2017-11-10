<?php

namespace Amorphous\Phpservices\Views;

/**
 * Class View
 * @package Amorphous\Phpservices\Views
 */
class View {
	/**
	 * @var $results
	 */
	public $results;

	/**
	 * @param $results
	 */
	public function setResults( $results ) {
		$this->results = $results;
	}

	/**
	 * @param $param
	 * @param $value
	 */
	public function set( $param, $value ) {
		$this->$param = $value;
	}

	/**
	 * @param $param
	 */
	public function render( $param ) {
		$param = strtolower( $param );
		require LAYOUTS . "$param.php";
	}
}