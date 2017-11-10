<?php

namespace Amorphous\Phpservices\Validators;

/**
 * Class InArray
 * @package Amorphous\Phpservices\Validators
 */
class InArray {

	public $values = [ ];

	public function validate( $value = NULL ) {
		if ( $this->values && in_array( $value, $this->values ) ) {
			return true;
		}

		return false;
	}

	public function setValues( array $values ) {
		$this->values = $values;
	}
}