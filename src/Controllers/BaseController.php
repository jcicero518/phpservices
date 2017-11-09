<?php

namespace Amorphous\Phpservices\Controllers;

use Amorphous\Phpservices\BaseFactoryService;

class BaseController {

	public $db;
	private $dbConfig = '../config/data/db.config.php';

	public function getDbService() {
		$config = include( $this->dbConfig );
		$this->db = BaseFactoryService::getDbService( $config );
	}
}