<?php

namespace app\controllers;

use app\controllers\AbstractMainController;

class MainController extends AbstractMainController
{

	/**
	 * Конструктор
	 *
	 * @param array $route Параметры маршрута
	 */
	public function __construct($route)
	{
		$route['controller'] = 'main';
		parent::__construct($route);

		$action = 'action' . $route['action'];
		$this->$action();
	}

	/**
	 * Главная страница
	 *
	 * @return void
	 */
	public function actionIndex()
	{
		$this->title = 'Главная страница';
		$this->meta_desc = 'Описание';
		$this->meta_key = 'Ключевые слова';
		$this->scripts = ['jquery-3.4.1.min.js', 'popper.min.js', 'bootstrap.min.js'];
		$this->styles = ['global:https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap', 'bootstrap.min.css', 'main.min.css'];
		$this->meta = [];
		$news = $this->model->getNews();
		$params = [
			'news' => $news,
		];
		$content = $this->view->render('index', $params, true);
		$this->render($content);
	}

	/**
	 * Вывод новости
	 *
	 * @return void
	 */
	public function actionNews()
	{
		$this->title = 'Новость';
		$this->meta_desc = 'Описание';
		$this->meta_key = 'Ключевые слова';
		$this->scripts = ['jquery-3.4.1.min.js', 'popper.min.js', 'bootstrap.min.js'];
		$this->styles = ['global:https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap', 'bootstrap.min.css', 'main.min.css'];
		$this->meta = [];
		$this->render('Новость №' . $this->route['id'] ?? 0);
	}
}
