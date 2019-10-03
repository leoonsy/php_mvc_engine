<?php

namespace app\core;

use app\lib\Db;

abstract class Model
{
	/**
	 * Дескриптор для работы с БД
	 *
	 * @var Db
	 */
	public $db;

	public function __construct()
	{
		$this->db = Db::getDBO();
	}
}
