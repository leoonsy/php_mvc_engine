<?php

namespace app\controllers;

use app\controllers\AbstractMainController;

class AccountController extends AbstractMainController {
	
	/**
	 * Конструктор
	 *
	 * @param array $route Параметры маршрута
	 */
	public function __construct($route)
	{
		$route['controller'] = 'account';
		parent::__construct($route);

		$action = 'action'.$route['action'];
		$this->$action();
	}

	/**
	 * Форма входа
	 *
	 * @return void
	 */
	public function actionLogin() {
		$this->title = 'Логин';
		$this->meta_desc = 'Описание';
		$this->meta_key = 'Ключевые слова';
		$this->scripts = ['jquery-3.4.1.min.js', 'popper.min.js', 'bootstrap.min.js'];
		$this->styles = ['global:https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap', 'bootstrap.min.css', 'main.min.css'];
		$this->meta = [];
		$content = "Форма входа";
		$this->render($content);
	}

	/**
	 * Форма регистрации
	 *
	 * @return void
	 */
	public function actionRegister() {
		$this->title = 'Регистрация';
		$this->meta_desc = 'Описание';
		$this->meta_key = 'Ключевые слова';
		$this->scripts = ['jquery-3.4.1.min.js', 'popper.min.js', 'bootstrap.min.js'];
		$this->styles = ['global:https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap', 'bootstrap.min.css', 'main.min.css'];
		$this->meta = [];
		$content = "Форма регистрации";
		$this->render($content);
	}

}