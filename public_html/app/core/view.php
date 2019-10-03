<?php

namespace app\core;

class View
{
	public $layout;

	public function __construct($layout)
	{
		$this->layout = $layout;
	}

	/**
	 * Отрисовывает страницу
	 *
	 * @param string $path Пусть до виды
	 * @param array $vars Массив замен
	 * @param boolean $return Записать результат в переменную
	 * @return void|string
	 */
	public function render($path, $vars = [], $return = false)
	{
		$template = 'app/views/dist/' . $this->layout . '/' . $path . '.tpl';
		extract($vars);
		ob_start();
		require($template);
		if ($return)
			return ob_get_clean();
		echo ob_get_clean();
	}
}
