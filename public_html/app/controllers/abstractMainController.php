<?php

namespace app\controllers;

use app\core\View;
use app\core\AbstractController;
use app\config\Config;
use app\modules\Header;
use app\modules\Menu;

abstract class AbstractMainController extends AbstractController
{
	/**
	 * Конструктор
	 *
	 * @param array $route Параметры маршрута
	 */
	public function __construct($route)
	{
		parent::__construct($route);
		$this->view = new View(Config::MAIN_LAYOUT);
	}

	/**
	 * Отрисовать всю страницу
	 *
	 * @param string $content Главный контент (HTML-код)
	 * @return void
	 */
	public function render($content)
	{
		$params = [];
		$params['header'] = $this->getHeader();
		$params['menu'] = Menu::getMenu($_SERVER['REQUEST_URI']);
		$params['scripts'] = Header::getScripts($this->scripts);
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
		$params = [];
		$params['title'] = $this->title;
		$params['meta_desc'] = $this->meta_desc;
		$params['meta_key'] = $this->meta_key;
		$params['styles'] = Header::getStyles($this->styles);
		$params['altMeta'] = Header::getMeta($this->meta);
		return $this->view->render(Header::getTmplFile(), $params, true);
	}
}
