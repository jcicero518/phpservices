<?php

namespace Amorphous\Phpservices\Database;

use Exception;

class SQLBuilder {

	public static $sql = '';
	public static $instance = NULL;
	public static $prefix = '';
	public static $join = '';
	public static $where = array();
	public static $group = '';
	public static $control = ['', ''];

	public static function init( $table, $queryType = 'SELECT', $cols = NULL ) {
		self::$instance = new self();

		if ( strtoupper( $queryType ) === 'SELECT' ) {
			self::select( $table, $cols );
		} else if ( strtoupper( $queryType ) === 'CREATE' ) {
			self::create( $table, $cols );
		} else {
			throw new Exception( 'Not a supported query type' );
		}

		return self::$instance;
	}
	/**
	 * @param $table
	 * @param null $cols
	 *
	 * @return SQLBuilder
	 *
	 * Returns singleton instance of class
	 */
	public static function select($table, $cols = NULL) {
		if ($cols) {
			self::$prefix = 'SELECT ' . $cols . ' FROM ' . $table;
		} else {
			self::$prefix = 'SELECT * FROM ' . $table;
		}

		return self::$instance;
	}

	public static function create( $table, array $cols ) {
		self::$prefix = 'INSERT INTO ' . $table .
			' VALUES (' . implode(',', $cols) . ') ';

		return self::$instance;
	}

	/**
	 * @param null $filter
	 *
	 * @return null
	 */
	public static function where($filter = NULL) {
		self::$where[0] = ' WHERE ' . $filter;
		return self::$instance;
	}

	/**
	 * @param $join1
	 * @param $join2
	 *
	 * @return null
	 */
	public static function innerJoin($join1, $join2) {
		self::$join = ' INNER JOIN ' . $join1 . ' ON ' . $join2;
		return self::$instance;
	}

	public static function like($a, $b) {
		self::$where[] = trim($a . ' LIKE ' . $b);
		return self::$instance;
	}

	public static function and($a = NULL) {
		self::$where[] = trim('AND ' . $a);
		return self::$instance;
	}

	public static function or($a = NULL) {
		self::$where[] = trim('OR' . $a);
		return self::$instance;
	}

	public static function in(array $a) {
		self::$where[] = 'IN ( ' . implode(',', $a) . ' )';
		return self::$instance;
	}

	public static function not($a = NULL) {
		self::$where[] = trim('NOT ' . $a);
		return self::$instance;
	}

	public static function limit($limit) {
		self::$control[0] = 'LIMIT ' . $limit;
		return self::$instance;
	}

	public static function offset($offset) {
		self::$control[1] = 'OFFSET ' . $offset;
		return self::$instance;
	}

	public static function group(array $fields) {
		self::$group = 'GROUP BY ' . implode(',', $fields);
		return self::$instance;
	}

	public static function getSql() {
		self::$sql = self::$prefix . self::$join . implode(' ', self::$where)
			. ' '
			. self::$group
			. ' '
			. self::$control[0]
			. ' '
			. self::$control[1];

		preg_replace('/ /', ' ', self::$sql);
		return trim(self::$sql);
	}
}