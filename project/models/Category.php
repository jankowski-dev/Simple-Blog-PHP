<?php

namespace Project\Models;

use \Core\Model;

class Category extends Model
{

	/********************************
	 * Метод получает одну запись.
	 * Принимает аргументом id записи
	 ********************************/

	public function getCategoryById($id)
	{
		return $this->findOne("SELECT * FROM category WHERE id=$id");
	}


	/********************************
	 * Метод получает все записи.
	 * Не принимает аргументов
	 ********************************/

	public function getCategories()
	{
		return $this->findMany("SELECT * FROM category");
	}


	/********************************
	 * Метод создает категорию.
	 * Принимает аргументом переменные
	 * с данными из формы
	 ********************************/

	public function create($data)
	{
		$sql = "INSERT category (title, description) VALUES (:title, :desc)";

		$rezult = self::$link->prepare($sql);
		$rezult->bindParam(':title', $data['заголовок'], \PDO::PARAM_STR);
		$rezult->bindParam(':desc', $data['описание'], \PDO::PARAM_STR);

		return $rezult->execute();
	}


	/********************************
	 * Метод обновляет категорию.
	 * Принимает аргументом переменные
	 * с данными из формы
	 ********************************/

	public function update($id, $data)
	{
		$sql = "UPDATE category SET title = :title, description = :desc WHERE id = :id";

		$rezult = self::$link->prepare($sql);
		$rezult->bindParam(':id', $id, \PDO::PARAM_STR);
		$rezult->bindParam(':title', $data['заголовок'], \PDO::PARAM_STR);
		$rezult->bindParam(':desc', $data['описание'], \PDO::PARAM_STR);

		return $rezult->execute();
	}


	/********************************
	 * Метод удаляет категорию из базы.
	 * Принимает аргументом id категории
	 ********************************/

	public function delete($id)
	{
		$sql = "DELETE FROM category WHERE id = :id";
		$rezult = self::$link->prepare($sql);
		$rezult->bindParam(':id', $id, \PDO::PARAM_STR);
		return $rezult->execute();
	}


	/********************************
	 * Метод считывает данные из формы.
	 * Не принимает аргументов и возвращает
	 * массив
	 ********************************/

	public function getData()
	{
		if (isset($_POST['submit'])) {

			$title          =  $_POST['title'];
			$description    =  $_POST['description'];

			$data = [
				'заголовок'    => $title,
				'описание'     => $description,
			];

			return $data;
		}
		return false;
	}


	/********************************
	 * Метод поверяет на валидность.
	 * Принимает аргументом массив
	 * данных из полей формы
	 ********************************/

	public function valCategory($arr)
	{
		$error = false;
		foreach ($arr as $key => $value) {
			if (empty($arr[$key])) {
				$error[] = 'Поле ' . '<b>' . $key . '</b>' . ' не может быть пустым!';
			}
		}
		return $error;
	}
}
