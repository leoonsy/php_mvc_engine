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
		$this->title = "Логин";
		$content = "Тут надо логин";
		$this->render($content);
	}

	/**
	 * Форма регистрации
	 *
	 * @return void
	 */
	public function actionRegister() {
		$this->title = "Регистрация";
		$content = "Тут нада регаца";
		$this->render($content);
	}

}