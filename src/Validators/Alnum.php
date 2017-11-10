<?php

namespace Amorphous\Phpservices\Validators;

/**
 * Class Alnum
 * @package Amorphous\Phpservices\Validators
 */
class Alnum {

	/**
	 * @param null $value
	 *
	 * @return bool
	 */
	public static function validate( $value = NULL ) {
		if ( empty( $value ) ) {
			return false;
		}

		if ( ctype_alnum( $value ) ) {
			return true;
		}

		return false;
	}
}