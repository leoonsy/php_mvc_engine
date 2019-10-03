<?php

namespace app\core;

use app\core\View;
use app\controllers\CodesController;

abstract class AbstractController
{
	/**
	 * Параметры обработки текущего маршрута (controller и action)
	 *
	 * @var array
	 */
	public $route;

	/**
	 * Объект представления
	 *
	 * @var View
	 */
	public $view;

	/**
	 * Массив прав доступа к страницам 
	 *
	 * @var array
	 */
    public $acl;

	/**
	 * Заголовок страницы
	 *
	 * @var string
	 */
	protected $title;

	/**
	 * Описание страницы
	 *
	 * @var string
	 */	
	protected $meta_desc;

	/**
	 * Ключевые слова страницы
	 *
	 * @var string
	 */
	protected $meta_key;

	/**
	 * Конструктор
	 *
	 * @param array $route Параметры маршрута
	 */
	public function __construct($route)
	{
		$this->route = $route;
		if (!$this->checkAcl())
			new CodesController(['action' => '403']);

		$this->model = $this->loadModel($route['controller']);		
    }

    /**
	 * Возвращает объект модели по имени
	 *
	 * @param string $name Имя модели
	 * @return mixed Объект модели или false
	 */
	public function loadModel($name)
	{
		$path = 'app\models\\' . $name;
		if (class_exists($path)) {
			return new $path;
		}
		return false;
    }
    
    public abstract function render($content);

    /**
	 * Проверяет права доступа посетителя к странице
	 *
	 * @return bool Имеется ли доступ
	 */
	public function checkAcl()
	{
		//TODO: сделать класс User и его юзать для проверок авторизованности
		$this->acl = require 'app/acl/' . $this->route['controller'] . '.php';

		if ($this->isAcl('all'))
			return true;		

		if (isset($_SESSION['admin']) && $this->isAcl('admin'))
			return true;

		return false;
	}

	/**
	 * Имеются ли права для посетителя типа $type к странице (к action данного controller)
	 *
	 * @param string $type 
	 * @return boolean
	 */
	private function isAcl($type)
	{
		return in_array($this->route['action'], $this->acl[$type]);
	}

	/**
	 * Перенаправляет на другую страницу
	 *
	 * @param [type] $url
	 * @return void
	 */
	public static function redirect($url)
	{
		header('location: ' . $url);
		exit;
	}
    
}