<?php

namespace Amorphous\Phpservices\AppForms\Inputs;

/**
 * Class Submit
 * @package Amorphous\Phpservices\AppForms\Inputs
 */
class Submit extends BaseInput {

	public function __construct() {
		$this->type  = 'submit';
		$this->name  = 'submit';
		$this->value = 'Submit';
	}

	/**
	 * @return string
	 */
	public function getInput() {
		return "<input type=\"$this->type\" name=\"$this->name\" value=\"$this->value\"/>";
	}
}