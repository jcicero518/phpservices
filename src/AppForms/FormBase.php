<?php

namespace Amorphous\Phpservices\AppForms;

use Amorphous\Phpservices\AppForms\Inputs\ {
	Checkbox,
	Hidden,
	Password,
	Select,
	Submit,
	Text
};

/**
 * Class FormBase
 * @package Amorphous\Phpservices\AppForms
 */
abstract class FormBase {

	public $models = [ ];
	public $config = [ ];
	protected $fields = [ ];
	protected $data;
	public $isValid = false;

	/**
	 * @param $models
	 * @param array $params
	 */
	public function __construct( $models, $params = NULL ) {
		$this->models = $models;
		$this->config = $params;
	}

	/**
	 * @return string
	 */
	public function getStartTag() {
		$config = $this->config;
		$form   = "<form";
		$form .= $config['id'] ? " id=\"{$config['id']}\"" : NULL;
		$form .= $config['name'] ? " name=\"{$config['name']}\"" : NULL;
		$form .= $config['action'] ? " action=\"{$config['action']}\"" : NULL;
		$form .= $config['method'] ? " method=\"{$config['method']}\"" : NULL;
		$form .= '>';

		return $form;
	}

	/**
	 * Generates fields from a configuration array
	 * @return bool
	 */
	public function generateFields() {
		$config   = $this->config;
		$newField = NULL;
		foreach ( $config['fields'] as $field ) {
			$newField = $this->generateField( $field );
		}

		if ( ! $newField ) {
			return false;
		} else {
			//Set common fields
			! empty( $field['value'] ) ? $newField->setValue( $field['value'] ) : NULL;
			! empty( $field['name'] ) ? $newField->setName( $field['name'] ) : NULL;
			! empty( $field['required'] ) ? $newField->setRequired( $field['required'] ) : NULL;
			! empty( $field['priority'] ) ? $this->fields[ $field['priority'] ] = $newField : NULL;
		}

		ksort( $this->fields );

		return true;
	}

	/**
	 * @param $field
	 *
	 * @return Checkbox|Hidden|Select|string|Submit|Text
	 */
	public function generateField( $field ) {
		$newField = '';
		switch ( $field['type'] ) {
			case 'text':
				$newField = new Text();
				$field['type'] ? $newField->setType( $field['type'] ) : NULL;
				$field['label'] ? $newField->setLabel( $field['label'] ) : NULL;
				$field['name'] ? $newField->setName( $field['name'] ) : NULL;
				$field['validator'] ? $newField->setValidators( $field['validator'] ) : NULL;
				break;
			case 'password':
				$newField = new Password();
				$field['type'] ? $newField->setType( $field['type'] ) : NULL;
				$field['label'] ? $newField->setLabel( $field['label'] ) : NULL;
				$field['name'] ? $newField->setName( $field['name'] ) : NULL;
				$field['validator'] ? $newField->setValidators( $field['validator'] ) : NULL;
				break;
			case 'submit':
				$newField = new Submit();
				break;
			case 'hidden':
				$newField = new Hidden();
				$field['value'] ? $newField->setValue( $field['value'] ) : NULL;
				$field['name'] ? $newField->setName( $field['name'] ) : NULL;
				$field['validator'] ? $newField->setValidators( $field['validator'] ) : NULL;
				break;
			case 'checkbox':
				$newField = new Checkbox();
				$field['type'] ? $newField->setType( $field['type'] ) : NULL;
				$field['label'] ? $newField->setLabel( $field['label'] ) : NULL;
				$field['name'] ? $newField->setName( $field['name'] ) : NULL;
				$field['validator'] ? $newField->setValidators( $field['validator'] ) : NULL;
				break;
			case 'select':
				$newField = new Select();
				$values   = NULL;
				$field['multiple'] ? $newField->setMultiple( $field['multiple'] ) : NULL;
				$field['label'] ? $newField->setLabel( $field['label'] ) : NULL;
				$field['name'] ? $newField->setName( $field['name'] ) : NULL;
				$field['options'] ? $newField->setOptions( $field['options'] ) : NULL;
				$field['validator'] ? $newField->setValidators( $field['validator'] ) : NULL;
				break;
		}

		return $newField;
	}

	/**
	 * @param $field
	 *
	 * @return bool|Checkbox|Hidden|Select|string|Submit|Text
	 */
	public function addField( $field ) {
		//var_dump($field);
		if ( $newField = $this->generateField( $field ) ) {
			$this->fields[ $field['priority'] ] = $newField;

			return $newField;
		};

		return false;
	}

	/**
	 * @param $data
	 *
	 * @return $this
	 */
	public function setData( $data ) {
		$this->data = $data;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 *Validate the form
	 */
	public function validate() {
		$invalidCount = 0;
		foreach ( $this->data as $key => $value ) {
			foreach ( $this->fields as $field ) {
				if ( $field->getName() == $key && $key !== 'submit' ) {
					foreach ( $field->getValidators() as $validator ) {
						if ( ! $validator->validate( $value ) ) {
							$invalidCount ++;
						}
					}
					if ( ! $invalidCount ) {
						$field->setValid();
					}
					break;
				}
			}
		}

		return $this->isValid = $invalidCount ? false : true;
	}

	/**
	 * @return array
	 */
	public function getFields() {
		return $this->fields;
	}

	/**
	 * @return array
	 */
	public function getField( $field ) {
		foreach ( $this->fields as $value ) {
			if ( $value->getName() === strtolower( $field ) ) {
				return $value;
			}
		}

		return false;
	}

	/**
	 * @param $field
	 * @param $value
	 *
	 * @return $this
	 */
	public function setField( $field, $value ) {
		$test = $this->getField( $field );
		$test->setValue( $value );

		return $this;
	}

	/**
	 * @return string
	 */
	public function getEndTag() {
		return '</form>';
	}
}