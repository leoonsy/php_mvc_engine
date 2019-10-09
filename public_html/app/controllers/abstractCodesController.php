<?php

namespace app\controllers;

use app\core\View;
use app\core\AbstractController;
use app\config\Config;

abstract class AbstractCodesController extends AbstractController
{
	/**
	 * Конструктор
	 *
	 * @param array $route Параметры маршрута
	 */
	public function __construct($route)
	{
		parent::__construct($route);
		$this->view = new View(Config::CODES_LAYOUT);
	}

	/**
	 * Отобразить всю страницу
	 *
	 * @param string $content Главный контент (HTML-код)
	 * @return void
	 */
	public function render($content)
	{
		$params = [];
		$params['header'] = $this->getHeader();
		$params['content'] = $content;
		$this->view->renderTemplate($params);
	}

	/**
	 * Получить шапку сайта
	 *
	 * @return void
	 */
	public function getHeader()
	{
		$param = [];
		$param['title'] = $this->title;
		$param['meta_desc'] = $this->meta_desc;
		$param['meta_key'] = $this->meta_key;
		return $this->view->render('header', $param, true);
	}
}
