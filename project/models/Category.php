<?php

namespace Project\Models;

use \Core\Model;

class Category extends Model
{

	public function getCategoryById($id)
	{
		return $this->findOne("SELECT * FROM category WHERE id=$id");
	}

	public function getCategoryAll()
	{
		return $this->findMany("SELECT * FROM category");
	}

	public function delete($id)
	{
		$sql = "DELETE FROM category WHERE id = :id";

		$rezult = self::$link->prepare($sql);
		$rezult->bindParam(':id', $id, \PDO::PARAM_STR);

		return $rezult->execute();
	}


	public function notEmpty($arr)
	{
		$error = false;
		foreach ($arr as $key => $value) {
			if (empty($arr[$key])) {
				$error[] = 'Поле ' . '<b>' . $key . '</b>' . ' не может быть пустым!';
			}
		}
		return $error;
	}


	/********************************
	 * Метод создает категорию.
	 * Принимает аргументом переменные
	 * с данными из формы
	 ********************************/

	public function create($title, $desc)
	{
		$sql = "INSERT category (title, description) VALUES (:title, :desc)";

		$rezult = self::$link->prepare($sql);
		$rezult->bindParam(':title', $title, \PDO::PARAM_STR);
		$rezult->bindParam(':desc', $desc, \PDO::PARAM_STR);

		return $rezult->execute();
	}

	/********************************
	 * Метод обновляет категорию.
	 * Принимает аргументом переменные
	 * с данными из формы
	 ********************************/

	public function update($id, $title, $desc)
	{
		$sql = "UPDATE category SET title = :title, description = :desc WHERE id = :id";

		$rezult = self::$link->prepare($sql);
		$rezult->bindParam(':id', $id, \PDO::PARAM_STR);
		$rezult->bindParam(':title', $title, \PDO::PARAM_STR);
		$rezult->bindParam(':desc', $desc, \PDO::PARAM_STR);

		return $rezult->execute();
	}
}
