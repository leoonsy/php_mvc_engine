<?php

namespace app\lib;

use PDO;
use app\config\Config;

class Db {

	/**
	 * Соединение с СУБД
	 *
	 * @var PDO
	 */
	protected $db;
	/**
	 * Экземпляр данного класса
	 *
	 * @var Db
	 */
	protected static $instance;
	
	/**
	 * Undocumented function
	 *
	 * @param string $dbHost Название хоста
	 * @param string $dbUser Имя пользователя
	 * @param string $dbPassword Пароль пользователя
	 * @param string $dbName Имя БД
	 */
	private function __construct($dbHost, $dbUser, $dbPassword, $dbName) {
		$this->db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName.';charset=utf8', $dbUser, $dbPassword);
	}

	/**
	 * Получает объект Db
	 *
	 * @return void
	 */
	public static function getDBO() {
		if (self::$instance == null) 
			self::$instance = new Db(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
		return self::$instance;
	}

	/**
	 * Выполняет запрос
	 *
	 * @param string $sql sql-запрос
	 * @param array $params Переменнные sql-запроса
	 * @return PDOStatement
	 */
	public function query($sql, $params = []) {
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
		return $stmt;
	}

	/**
	 * Возвращает массив, содержащий все строки набора
	 *
	 * @param [type] $sql
	 * @param array $params
	 * @return void
	 */
	public function rows($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}
}