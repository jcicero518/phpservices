<?php

namespace Amorphous\Phpservices\Models;

use Amorphous\Phpservices\Database\SQLBuilder;
use PDO;
use PDOException;

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
	 * @var $modelTable
	 */
	protected $modelTable;

	/**
	 * UserModel constructor.
	 *
	 * @param $pdo
	 */
	public function __construct( PDO $pdo ) {
		$this->db = $pdo;
		$this->modelTable = 'users';
	}

	public function setModelTable( $modelTable ) {
		$this->modelTable = $modelTable;
	}

	public function getModelTable() {
		return $this->modelTable;
	}

	public function getUsers() {
		$sql = SQLBuilder::init( $this->modelTable, 'SELECT' )->getSql();
		$users = [];
		try {
			$users = $this->db->query( $sql, PDO::FETCH_ASSOC );
		} catch( PDOException $e ) {
			echo $e->getMessage();
		}

		return $users;
	}

	public function authenticate( $data ) {
		$sql = SQLBuilder::init( $this->modelTable )->where( ":username = '{$data['username']}'" );
		try {
			$stmt = $this->db->prepare( $sql );
			$stmt->bindParam( ':username', $data['username'], PDO::PARAM_STR );
			$stmt->execute();

			$result = $stmt->fetch( PDO::FETCH_ASSOC );
			if( $result && password_verify( $data['password'], $result['password'] ) ) {
				return $result;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			error_log( $e->getMessage() );
		}
	}
}