<?php

namespace Project\Models;

use \Core\Model;

class Post extends Model
{
	// Получить все записи
	// public function getPostAll()
	// {
	// 	return $this->findMany("SELECT post.id, post.title, post.date, category FROM post JOIN category ON category.id = post.category_id");
	// }

	public function getPostAll()
	{
		return $this->findMany("SELECT * FROM post");
	}

	// Получить одну запись
	public function getPostById($id)
	{
		return $this->findOne("SELECT * FROM post WHERE id=$id");
	}

	// Метод обновления существующего поста
	public function update($id, $title, $desc, $keyword, $story)
	{
		$sql = "UPDATE post SET title = :title, description = :desc, keyword = :keyword, story = :story WHERE id = :id";

		$rezult = self::$link->prepare($sql);
		$rezult->bindParam(':id', $id, \PDO::PARAM_STR);
		$rezult->bindParam(':title', $title, \PDO::PARAM_STR);
		$rezult->bindParam(':desc', $desc, \PDO::PARAM_STR);
		$rezult->bindParam(':keyword', $keyword, \PDO::PARAM_STR);
		$rezult->bindParam(':story', $story, \PDO::PARAM_STR);

		return $rezult->execute();
	}

	// Метод создания нового поста
	public function create($title, $desc, $keyword, $story)
	{
		$sql = "INSERT post (title, description, keyword, story) VALUES (:title, :desc, :keyword, :story)";

		$rezult = self::$link->prepare($sql);
		$rezult->bindParam(':title', $title, \PDO::PARAM_STR);
		$rezult->bindParam(':desc', $desc, \PDO::PARAM_STR);
		$rezult->bindParam(':keyword', $keyword, \PDO::PARAM_STR);
		$rezult->bindParam(':story', $story, \PDO::PARAM_STR);

		return $rezult->execute();
	}

	// Метод одиночного удаления поста
	public function delete($id)
	{
		$sql = "DELETE FROM post WHERE id = :id";

		$rezult = self::$link->prepare($sql);
		$rezult->bindParam(':id', $id, \PDO::PARAM_STR);

		return $rezult->execute();
	}

	// // Метод множественного удаления поста
	// public function deleteAll($id)
	// {
	// 	$sql = "DELETE FROM post WHERE id = :id";

	// 	$rezult = self::$link->prepare($sql);
	// 	$rezult->bindParam(':id', $id, \PDO::PARAM_STR);

	// 	return $rezult->execute();
	// }
}
