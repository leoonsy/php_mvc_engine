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
	 * Отрисовывает вид
	 *
	 * @param string $path Пусть до частей шаблона
	 * @param array $vars Массив замен
	 * @param boolean $return Записать результат в переменную
	 * @return void|string
	 */
	public function render($path, $vars = [], $return = false)
	{
		$template = 'app/views/dist/' . $path . '.tpl';
		extract($vars);
		ob_start();
		require($template);
		if ($return)
			return ob_get_clean();
		echo ob_get_clean();
	}

		/**
	 * Отрисовывает шаблон
	 *
	 * @param string $path Название шаблона
	 * @param array $vars Массив замен
	 * @param boolean $return Записать результат в переменную
	 * @return void|string
	 */
	public function renderTemplate($vars = [], $return = false)
	{
		$template = 'app/views/dist/templates/' . $this->layout . '.tpl';
		extract($vars);
		ob_start();
		require($template);
		if ($return)
			return ob_get_clean();
		echo ob_get_clean();
	}
}
