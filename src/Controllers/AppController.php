<?php

namespace Amorphous\Phpservices\Controllers;

use Amorphous\Phpservices\BaseFactoryService;
use Amorphous\Phpservices\Views\View;
use Amorphous\Phpservices\Models\UserModel;
use Amorphous\Phpservices\AppForms\LoginForm;
use Amorphous\Phpservices\AppForms\RegisterForm;

class AppController {

	const USERS_TABLE = 'users';

	protected $form;
	protected $view;
	protected $models;

	public function __construct() {

	}

	public function init() {
		$config = BaseFactoryService::getConfig();

		$this->models = [
			'user' => BaseFactoryService::getModels( UserModel::class, $config )
		];

		$this->view = new View();

		if ( ! $_POST && empty( $_GET['action'] ) ) {
			$this->form = BaseFactoryService::getForm( LoginForm::class, $this->models );

			//Set the token field into the session
			$this->saveSessionToken();

			$this->view->set( 'form', $this->form );
			$this->view->render( 'login' );

		} elseif ( $_GET && $_GET['action'] === 'register' ) {
			$this->form = BaseFactoryService::getForm( RegisterForm::class, $this->models );

			//Set the token field into the session
			$this->saveSessionToken();

			$this->view->set( 'form', $this->form );
			$this->view->render( 'register' );

			// process login form
		} elseif ( $_POST && $_POST['submit'] ) {
			$session = BaseFactoryService::getSession();
			$token   = $session->get( 'token' );

			if ( $_POST['submit'] === 'login' ) {
				$this->form = BaseFactoryService::getForm( LoginForm::class, $this->models );
			}
			if ( $_POST['submit'] === 'register' ) {
				$this->form = BaseFactoryService::getForm( RegisterForm::class, $this->models );
			}

			//Pull the token from the session and set it in the form for validation
			$this->form->setField( 'token', $token );

			$this->form->setData( $_POST );
			if ( $this->form->validate() ) {
				if ( $this->form->config['name'] === 'login' ) {
					$this->login();
				}
				if ( $this->form->config['name'] === 'register' ) {
					$this->register();
				}
			} else {
				$this->view->render( 'invalid' );
			}
		} //Logout the user
		elseif ( $_GET && $_GET['action'] === 'logout' ) {
			$this->logout();
		}

		return $this;
	}

	/**
	 * Save session token
	 */
	public function saveSessionToken() {
		//Set the token field into the session
		$session = BaseFactoryService::getSession();
		$session->save( [
			'token' => $this->form->getField( 'token' )->getValue()
		] );
	}

	/**
	 * Login user
	 */
	public function login() {
		//Code to authenticate user
		$user = $this->models['user']->authenticate( $this->form->getData() );
		if ( $user ) {
			$this->view->user = $user;
			//Render some "Welcome"
			$this->view->render( 'welcome' );
		} else {
			//Show no remorse
			$this->view->render( 'invalid' );
		}
	}

	/**
	 *Logout user
	 */
	public function logout() {
		$session = BaseFactoryService::getSession();
		$session->destroy();
		$url = strip_tags( $_SERVER['HTTP_REFERER'] );
		header( "Location: $url" );
		exit;
	}

	/**
	 * Register new user
	 */
	public function register() {
		//Code to save the new user
		$this->models['user']->saveUser( $this->form->getData() );

		//Say "thanks"
		$this->view->render( 'thanks' );
	}
}