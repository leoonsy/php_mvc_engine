<?php

namespace app\lib;

use PDO;
use app\config\Config;
class Db
{

	/**
	 * Объект PDO
	 *
	 * @var PDO
	 */
	protected $db;

	/**
	 * Экземпляр класса
	 *
	 * @var Db
	 */
	protected static $instance;

	private function __construct($dbHost, $dbUser, $dbPassword, $dbName)
	{
		$this->db = new PDO('mysql:host=' . $dbHost . ';dbname=' . $dbName . ';charset=utf8', $dbUser, $dbPassword);
	}

	/**
	 * Получить экземпляр PDO
	 *
	 * @return Db
	 */
	public static function getDBO()
	{
		if (self::$instance == null) {
			self::$instance = new Db(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
			self::$instance->setPDOConfig();
		}
		return self::$instance;
	}

	/**
	 * Установить конфигурацию PDO
	 *
	 * @return void
	 */
	private function setPDOConfig()
	{
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	/**
	 * Выполнить запрос к БД
	 *
	 * @param string $sql
	 * @param array $params
	 * @return PDOStatement
	 */
	public function query($sql, $params = [])
	{
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
		return $stmt;
	}

	/**
	 * Выбрать все записи
	 *
	 * @param string $sql
	 * @param array $params
	 * @return array
	 */
	public function getAll($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Выбрать одну запись
	 *
	 * @param string $sql
	 * @param array $params
	 * @return array
	 */
	public function getFirst($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Выбрать столбец
	 *
	 * @param string $sql
	 * @param array $params
	 * @param integer $column
	 * @return mixed
	 */
	public function getColumn($sql, $params = [], $column = 0)
	{
		$result = $this->query($sql, $params);
		return $result->fetchColumn($column);
	}

	/**
	 * Получить ID последней вставленной записи
	 *
	 * @return int
	 */
	public function getLastInsertId()
	{
		return $this->db->lastInsertId();
	}

	/**
	 * Экранировать спецсимволы
	 *
	 * @param string $str
	 * @param boolean $isWrap
	 * @return void
	 */
	public function quote($str, $isWrap = true)
	{
		if ($isWrap)
			return $this->db->quote($str);
		else
			return substr($this->db->quote($str), 1, -1);
	}
}