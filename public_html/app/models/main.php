<?php

namespace app\models;

use app\core\Model;

class Main extends Model
{
	/**
	 * Получить список новостей
	 *
	 * @return void
	 */
	public function getNews()
	{
		$result = $this->db->getAll('SELECT `title`, `description` FROM `news`');
		return $result;
	}
}
