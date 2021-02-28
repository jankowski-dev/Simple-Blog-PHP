<?php

namespace Project\Models;

use \Core\Model;

class Post extends Model
{

	/********************************
	 * Метод получает все записи.
	 * JOIN с таблицой категорий.
	 ********************************/

	public function getPostAll()
	{
		return $this->findMany("SELECT post.id, post.title, post.date, category.title as category FROM post JOIN category ON category.id = post.category_id ORDER BY post.id;");
	}


	/********************************
	 * Метод получает одну запись.
	 * Принимает аргументом id записи
	 ********************************/

	public function getPostById($id)
	{
		return $this->findOne("SELECT * FROM post WHERE id=$id");
	}


	/********************************
	 * Метод обновляет пост.
	 * Принимает аргументом переменные
	 * с данными из формы
	 ********************************/

	public function update($id, $title, $category_id, $desc, $keyword, $story)
	{
		$sql = "UPDATE post SET title = :title, category_id = :category_id, description = :desc, keyword = :keyword, story = :story WHERE id = :id";

		$rezult = self::$link->prepare($sql);
		$rezult->bindParam(':id', $id, \PDO::PARAM_STR);
		$rezult->bindParam(':title', $title, \PDO::PARAM_STR);
		$rezult->bindParam(':category_id', $category_id, \PDO::PARAM_STR);
		$rezult->bindParam(':desc', $desc, \PDO::PARAM_STR);
		$rezult->bindParam(':keyword', $keyword, \PDO::PARAM_STR);
		$rezult->bindParam(':story', $story, \PDO::PARAM_STR);

		return $rezult->execute();
	}


	/********************************
	 * Метод создает пост.
	 * Принимает аргументом переменные
	 * с данными из формы
	 ********************************/

	public function create($title, $category_id, $desc, $keyword, $story)
	{
		$sql = "INSERT post (title, category_id, description, keyword, story) VALUES (:title, :category_id, :desc, :keyword, :story)";

		$rezult = self::$link->prepare($sql);
		$rezult->bindParam(':title', $title, \PDO::PARAM_STR);
		$rezult->bindParam(':category_id', $category_id, \PDO::PARAM_STR);
		$rezult->bindParam(':desc', $desc, \PDO::PARAM_STR);
		$rezult->bindParam(':keyword', $keyword, \PDO::PARAM_STR);
		$rezult->bindParam(':story', $story, \PDO::PARAM_STR);

		return $rezult->execute();
	}


	/********************************
	 * Метод удаляет пост.
	 * Принимает аргументом id поста
	 ********************************/

	public function delete($id)
	{
		$sql = "DELETE FROM post WHERE id = :id";

		$rezult = self::$link->prepare($sql);
		$rezult->bindParam(':id', $id, \PDO::PARAM_STR);

		return $rezult->execute();
	}

	/********************************
	 * Метод поверяет на валидность.
	 * Принимает аргументом массив
	 * данных из полей формы
	 ********************************/

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
}
