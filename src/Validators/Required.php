<?php

namespace Amorphous\Phpservices\Validators;

/**
 * Class Required
 * @package Amorphous\Phpservices\Validators
 */
class Required {

	public function validate( $value = NULL ) {
		if ( ! empty( $value ) ) {
			return true;
		}

		return false;
	}
}