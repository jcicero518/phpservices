<?php

namespace Amorphous\Phpservices\Database;

use PDO;

class SQLFactory {

	protected $db;
	protected $queryType = 'SELECT';

	protected $statement;

	public function __construct( PDO $pdo ) {
		$this->db = $pdo;
	}

	public function setQueryParts() {

	}

	public function prepareStatement( $sql ) {
		$this->statement = $this->db->prepare( $sql );
		return $this;
	}

	public function bindParams() {

	}
}