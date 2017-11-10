<?php

namespace Amorphous\Phpservices\Models;

use PDO;

interface BaseModelInterface {

	public function __construct( PDO $pdo );
	public function setModelTable( $table );
	public function getModelTable();
}