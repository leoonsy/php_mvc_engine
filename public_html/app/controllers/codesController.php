<?php

namespace app\controllers;

use app\controllers\AbstractCodesController;

class CodesController extends AbstractCodesController {

	/**
	 * Конструктор
	 *
	 * @param array $route Параметры маршрута
	 */
	public function __construct($route)
	{
		$route['controller'] = 'codes';
		parent::__construct($route);

		$action = 'action'.$route['action'];
		$this->$action();
		exit();
	}

	/**
	 * Ошибка 404
	 *
	 * @return void
	 */
	public function action404() {
		$this->title = 'Ошибка 404';
		$this->meta_desc = 'Запрошенная страница не существует';
		$this->meta_key = 'Страница не найдена, страница не существует, 404';
		$this->scripts = ['jquery-3.4.1.min.js', 'popper.min.js', 'bootstrap.min.js'];
		$this->styles = ['global:https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap', 'bootstrap.min.css', '404.min.css'];
		$this->meta = [];
		$content = $this->view->render('404', [], true);
		$this->render($content);
	}

	/**
	 * Ошибка 403
	 *
	 * @return void
	 */
	public function action403() {
		$this->title = 'Доступ запрещен';
		$this->meta_desc = 'К данной странице доступ запрещен';
		$this->meta_key = 'Доступ запрещен, 403, ошибка';
		$this->scripts = ['jquery-3.4.1.min.js', 'popper.min.js', 'bootstrap.min.js'];
		$this->styles = ['global:https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap', 'bootstrap.min.css', '404.min.css'];
		$this->meta = [];
		$content = $this->view->render('403', [], true);
		$this->render($content);
	}	
}