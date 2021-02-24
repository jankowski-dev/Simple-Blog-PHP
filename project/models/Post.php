<?php

namespace Project\Models;

use \Core\Model;

class Post extends Model
{
	public function getPostAll()
	{
		return $this->findMany("SELECT * FROM post");
	}

	public function getPostById($id)
	{
		return $this->findOne("SELECT * FROM post WHERE id=$id");
	}

	// public function updatePost($id, $title, $desc, $keyword, $story)
	// {
	// 	return $this->findOne("UPDATE post SET title = $title, description = $desc, keyword = $keyword, story = $story WHERE id=$id");
	// }

	// Метод добавления нового пользователя
	public function updatePost($id, $title, $desc, $keyword, $story)
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
}
