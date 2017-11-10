<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

define( 'LAYOUTS', __DIR__ . DIRECTORY_SEPARATOR . 'src/Layouts' . DIRECTORY_SEPARATOR );

require_once( 'vendor/autoload.php' );

$app = new \Amorphous\Phpservices\Controllers\AppController();
$app->init();
/*$app = new App();
$app->get('/', function( Request $request, Response $response): Response {
	return $response->withJson([
		'message' => 'Something in JSON'
	]);
});

$app->get( '/users/{username}', function( Request $request, Response $response, array $args ): Response {
	return $response->withJson([
		'message' => 'More about user ' . $args['username']
	]);
});

$app->run();*/
