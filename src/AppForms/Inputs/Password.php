<?php

namespace Amorphous\Phpservices\AppForms\Inputs;

/**
 * Class Password
 * @package Amorphous\Phpservices\AppForms\Inputs
 */
class Password extends BaseInput {

	public function __construct() {
		$this->type     = 'password';
		$this->required = true;
	}

	/**
	 * @return string
	 */
	public function getInput() {
		$required = $this->required ? ' required' : NULL;

		return "<input type=\"$this->type\" name=\"$this->name\" $required/>";
	}
}