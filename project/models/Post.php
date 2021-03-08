<?php

namespace Project\Models;

use \Core\Model;

class Post extends Model
{

	/********************************
	 * Метод получает все записи.
	 * JOIN с таблицой категорий.
	 ********************************/

	public function getPosts()
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
	 * Метод делает запись в базу данных.
	 * Аргументом принимает массив с данными
	 ********************************/

	public function create($data)
	{

		$sql = "INSERT post (title, category_id, description, keyword, story, author_id) VALUES (:title, :category_id, :desc, :keyword, :story, :author_id)";

		$result = self::$link->prepare($sql);
		$result->bindParam(':title', $data['заголовок'], \PDO::PARAM_STR);
		$result->bindParam(':category_id', $data['категория'], \PDO::PARAM_STR);
		$result->bindParam(':desc', $data['описание'], \PDO::PARAM_STR);
		$result->bindParam(':keyword', $data['ключевые слова'], \PDO::PARAM_STR);
		$result->bindParam(':story', $data['текст поста'], \PDO::PARAM_STR);
		$result->bindParam(':author_id', $data['автор'], \PDO::PARAM_STR);

		return $result->execute();
	}


	/********************************
	 * Метод обновляет пост.
	 * Принимает аргументом id поста
	 * и массив данных
	 ********************************/

	public function update($id, $data)
	{
		$sql = "UPDATE post SET title = :title, category_id = :category_id, description = :desc, keyword = :keyword, story = :story WHERE id = :id";

		$result = self::$link->prepare($sql);
		$result->bindParam(':id', $id, \PDO::PARAM_STR);
		$result->bindParam(':title', $data['заголовок'], \PDO::PARAM_STR);
		$result->bindParam(':category_id', $data['категория'], \PDO::PARAM_STR);
		$result->bindParam(':desc', $data['описание'], \PDO::PARAM_STR);
		$result->bindParam(':keyword', $data['ключевые слова'], \PDO::PARAM_STR);
		$result->bindParam(':story', $data['текст поста'], \PDO::PARAM_STR);

		return $result->execute();
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
	 * Метод считывает данные из формы.
	 * Не принимает аргументов и возвращает
	 * массив
	 ********************************/

	public function getData()
	{
		if (isset($_POST['submit'])) {

			$title          =  $_POST['title'];
			$description    =  $_POST['description'];
			$keyword        =  $_POST['keyword'];
			$category_id    =  $_POST['category_id'];
			$story          =  $_POST['story'];
			$author_id      =  $_SESSION['id'];

			$data = [
				'заголовок'         => $title,
				'описание'          => $description,
				'ключевые слова'    => $keyword,
				'категория'         => $category_id,
				'текст поста'       => $story,
				'автор' 			=> $author_id
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

	public function valPost($arr)
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
