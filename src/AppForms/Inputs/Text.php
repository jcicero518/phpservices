<?php

namespace Amorphous\Phpservices\AppForms\Inputs;

class Text extends BaseInput {

	public function __construct() {
		$this->type     = 'text';
		$this->required = false;
	}

	/**
	 * @return string
	 */
	public function getInput() {
		$required = $this->required ? ' required' : NULL;

		return "<input type=\"$this->type\" name=\"$this->name\" $required/>";
	}
}