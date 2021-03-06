<?php

namespace Amorphous\Phpservices;

use PDO;
use PDOException;
use Exception;

/**
 * Class BaseFactoryService
 *
 * @package Amorphous\Phpservices
 */
abstract class BaseFactoryService {

	const ERROR_UNABLE = 'ERROR: Unable to create database connection';
	/**
	 * @var PDO
	 */
	public static $pdo;
	/**
	 * @var $config array
	 */
	public static $config;
	/**
	 * @var $session
	 */
	public static $session;
	/**
	 * @var $models
	 */
	public static $models = [];

	public static function getDbService( array $config ) {

		if ( ! isset( $config['driver'] ) ) {
			throw new Exception( __METHOD__ . ': ' . self::ERROR_UNABLE . PHP_EOL );
		}

		$dsn = $config['driver']
		       . ':host=' . $config['host']
		       . ';dbname=' . $config['dbname'];

		if ( ! self::$pdo ) {
			try {
				self::$pdo = new PDO( $dsn,
					$config['user'],
					$config['password'],
					[ PDO::ATTR_ERRMODE => $config['errmode'] ]
				);
			} catch ( PDOException $e ) {
				error_log( $e->getMessage() );
			}
		}

		return self::$pdo;
	}

	public static function getConfig() {

		if ( ! self::$config ) {
			self::$config = require( 'config/data/db.config.php' );
		}

		return self::$config;
	}

	public static function getSession() {
		if ( ! self::$session ) {
			self::$session = new Session();
		}

		return self::$session;
	}

	public static function getModel( $model, $config ) {

		if ( ! isset( self::$models[ $model ] ) ) {
			self::$models[ $model ] = new $model( self::getDbService( $config ) );
		}

		return self::$models[ $model ];
	}

	/**
	 * Provides form class abstraction
	 *
	 * @param $form
	 * @param $model
	 *
	 * @return object $form The form object
	 */
	public static function getForm( $form, $model ) {
		if ( ! $form && ! $model ) {
			return false;
		}

		return new $form( $model );
	}
}