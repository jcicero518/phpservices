<?php

namespace Amorphous\Phpservices\Models;


use Amorphous\Phpservices\Database\SQLBuilder;
use PDO;

class CountryModel implements BaseModelInterface {

	/**
	 * @var $db
	 */
	protected $db;
	/**
	 * @var $modelTable
	 */
	protected $modelTable;

	public function __construct(PDO $pdo) {
		$this->db = $pdo;
		$this->modelTable = 'country';
	}

	public function setModelTable($table) {
		$this->modelTable = $table;
	}

	public function getModelTable() {
		return $this->modelTable;
	}

	public function getCountries() {
		$sql = SQLBuilder::init( $this->modelTable, 'SELECT', 'name' )->getSql();
		$stmt = $this->db->query( $sql );
		$results = $stmt->fetchAll( PDO::FETCH_COLUMN );
		sort( $results );

		return $results;
	}
}