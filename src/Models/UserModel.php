<?php

namespace Amorphous\Phpservices\Models;

/**
 * Class UserModel
 *
 * @package Amorphous\Phpservices\Models
 */
class UserModel implements BaseModelInterface {

	/**
	 * @var $db
	 */
	protected $db;

	/**
	 * UserModel constructor.
	 *
	 * @param $pdo
	 */
	public function __construct( $pdo ) {
		$this->db = $pdo;
	}
}