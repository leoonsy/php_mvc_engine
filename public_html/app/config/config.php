<?php

namespace app\config;

abstract class Config
{
	/**
	 * Шаблон по умолчанию
	 */
	const MAIN_LAYOUT = "main";
	/**
	 * Шаблон администратора
	 */
	const ADMIN_LAYOUT = "admin";
	/**
	 * Шаблон кодов HTTP
	 */
	const CODES_LAYOUT = "codes";
	/**
	 * Сервер СУБД
	 */
	const DB_HOST = "localhost";
	/**
	 * Имя пользователя СУБД
	 */
	const DB_USER = "leoon";
	/**
	 * Пароль пользователя СУБД
	 */
	const DB_PASSWORD = "1762354";
	/**
	 * Имя БД
	 */
	const DB_NAME = "engine";
	/**
	 * Директория с видами
	 */
	const DIR_TMPL = "app/views/dist";

	/**
	 * Публичная директория с изображениями, скриптами, стилями
	 */
	const DIR_PUBLIC = "public/dist";
}
