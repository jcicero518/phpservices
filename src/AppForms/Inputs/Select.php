<?php

namespace Amorphous\Phpservices\AppForms\Inputs;

/**
 * Class Select
 * @package Amorphous\Phpservices\AppForms\Inputs
 */
class Select extends BaseInput {

	protected $multiple = false;
	protected $options = [ ];

	public function __construct() {
		$this->valid    = false;
		$this->required = false;
	}

	/**
	 * @return string
	 */
	public function getInput() {
		$select = "<select";
		$select .= $this->name ? " name=\"$this->name\"" : NULL;
		$select .= $this->required ? " required" : NULL;
		$select .= $this->multiple ? " multiple" : NULL;
		$select .= ">";
		foreach ( $this->options as $option ) {
			$select .= $option;
		}
		$select .= "</select>";

		return $select;
	}

	/**
	 * @return boolean
	 */
	public function isMultiple() {
		return $this->multiple;
	}

	/**
	 * @param boolean $multiple
	 *
	 * @return $this
	 */
	public function setMultiple( $multiple ) {
		$this->multiple = $multiple;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * @param array $options
	 *
	 * @return $this
	 */
	public function setOptions( array $options ) {
		$this->options = $options;

		return $this;
	}
}