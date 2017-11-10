<?php

namespace Amorphous\Phpservices\Validators;

/**
 * Class Boolean
 * @package Amorphous\Phpservices\Validators
 */
class Boolean {

	public function validate( $value = NULL ) {
		if ( $value == 0 || $value == 1 ) {
			return true;
		}

		return false;
	}
}