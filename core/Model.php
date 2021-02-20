<?php

namespace Core;

use Project\Config\Db;

class Model
{
	private static $link;

	// Установка соединения с базой
	public function __construct()
	{
		if (!self::$link) {
			self::$link = Db::getInstance()->getConnection();
			echo "Подключение установлено";
		} else {
			echo "Подключение не установлено";
		}
	}

	// Одиночная выборка из базы
	protected function findOne($query)
	{
		$rezult = self::$link->prepare($query);
		$rezult->setFetchMode(\PDO::FETCH_ASSOC);
		$rezult->execute();
		$data = $rezult->fetch();
		return $data;
	}

	// Множественная выборка из базы
	protected function findMany($query)
	{
		$data = [];
		$rezult = self::$link->prepare($query);
		$rezult->setFetchMode(\PDO::FETCH_ASSOC);
		$rezult->execute();
		$arrays = $rezult->fetchAll(\PDO::FETCH_ASSOC);
		foreach ($arrays as $key => $value) {
			$data[$key] = $value;
		}
		return $data;
	}
}
