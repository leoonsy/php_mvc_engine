<?php

namespace app\controllers;

use app\controllers\AbstractDefaultController;

class MainController extends AbstractDefaultController
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
		$this->render('Новость №' . $this->route['id'] ?? 0);
	}
}
