<?php

namespace Amorphous\Phpservices\Validators;

/**
 * Class Alpha
 * @package Amorphous\Phpservices\Validators
 */
class Alpha {

	/**
	 * @param null $value
	 *
	 * @return bool
	 */
	public function validate( $value = NULL ) {
		if ( empty( $value ) ) {
			return false;
		}

		if ( ctype_alpha( $value ) ) {
			return true;
		}

		return false;
	}
}