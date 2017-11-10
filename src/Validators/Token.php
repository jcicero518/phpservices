<?php

namespace Amorphous\Phpservices\Validators;

use Amorphous\Phpservices\BaseFactoryService;

/**
 * Class Token
 * @package Amorphous\Phpservices\Validators
 */
class Token {

	/**
	 * @param null $value
	 *
	 * @return bool
	 */
	public function validate( $value ) {
		if ( empty( $value ) ) {
			return false;
		}
		$session = BaseFactoryService::getSession();
		$token   = $session->get( 'token' );
		if ( $value === $token ) {
			return true;
		}

		return false;
	}
}