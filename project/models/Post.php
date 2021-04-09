<?php

namespace Project\Models;

use \Core\Model;
use \Project\Models\File;

class Post extends Model
{

	/********************************
	 * Метод получает все записи.
	 * JOIN с таблицой категорий.
	 ********************************/

	public function getPosts()
	{
		return $this->findMany("SELECT post.id, post.title, post.description, post.main_post, post.fixed, post.date, category.title as category
								FROM post JOIN category ON category.id = post.category_id
								ORDER BY post.id DESC");
	}


	/********************************
	 * Метод получает одну запись.
	 * Принимает аргументом id записи
	 ********************************/

	public function getPostById($id)
	{
		return $this->findOne("SELECT post.id, post.main_post, post.fixed, post.image, post.title, post.description,
							   post.date, post.keyword, post.story, post.category_id, category.title as category
							   FROM post JOIN category ON category.id = post.category_id
							   WHERE post.id = $id");
	}


	/********************************
	 * Метод получает главный пост.
	 * Принимает аргументом массив данных
	 ********************************/

	public function getMainPost($data)
	{
		foreach ($data as $post) {
			if ($post['main_post'] == 1) {
				return $post;
			}
		}
		return 1;
	}


	/********************************
	 * Метод получает массив фиксированных постов.
	 * Принимает аргументом массив данных
	 ********************************/

	public function getFixedPost($data)
	{
		$fixedPosts = false;
		foreach ($data as $post) {
			if ($post['fixed'] == 1) {
				$fixedPosts[] = $post;
			}
		}
		return $result = $fixedPosts ? $fixedPosts : false;
	}


	/********************************
	 * Метод получает массив отобранных данных.
	 * Не включает в себя фиксированные и главные посты
	 * Принимает аргументом массив данных
	 ********************************/

	public function getLastPosts($data)
	{
		$posts = false;
		foreach ($data as $post) {
			if ($post['fixed'] == 0 and $post['main_post'] == 0) {
				$posts[] = $post;
			}
		}
		return $result = $posts ? $posts : false;
	}


	/********************************
	 * Метод делает запись в базу данных.
	 * Аргументом принимает массив с данными
	 ********************************/

	public function create($data)
	{

		$sql = "INSERT post (title, category_id, description, keyword, story, author_id, fixed, main_post)
				VALUES (:title, :category_id, :desc, :keyword, :story, :author_id, :fixed, :main_post)";

		$result = self::$link->prepare($sql);
		$result->bindParam(':title', $data['заголовок'], \PDO::PARAM_STR);
		$result->bindParam(':category_id', $data['категория'], \PDO::PARAM_STR);
		$result->bindParam(':desc', $data['описание'], \PDO::PARAM_STR);
		$result->bindParam(':keyword', $data['ключевые слова'], \PDO::PARAM_STR);
		$result->bindParam(':story', $data['текст поста'], \PDO::PARAM_STR);
		$result->bindParam(':author_id', $data['автор'], \PDO::PARAM_STR);
		$result->bindParam(':fixed', $data['закреплен'], \PDO::PARAM_INT);
		$result->bindParam(':main_post', $data['главная новость'], \PDO::PARAM_INT);

		if ($result->execute()) {
			return self::$link->lastInsertId();
		}
		return false;
	}


	/********************************
	 * Метод обновляет пост.
	 * Принимает аргументом id поста
	 * и массив данных
	 ********************************/

	public function update($id, $data)
	{
		$sql = "UPDATE post SET title = :title, fixed = :fixed, main_post = :main_post,  category_id = :category_id, description = :desc, keyword = :keyword, story = :story WHERE id = :id";

		$result = self::$link->prepare($sql);
		$result->bindParam(':id', $id, \PDO::PARAM_STR);
		$result->bindParam(':title', $data['заголовок'], \PDO::PARAM_STR);
		$result->bindParam(':category_id', $data['категория'], \PDO::PARAM_STR);
		$result->bindParam(':desc', $data['описание'], \PDO::PARAM_STR);
		$result->bindParam(':keyword', $data['ключевые слова'], \PDO::PARAM_STR);
		$result->bindParam(':story', $data['текст поста'], \PDO::PARAM_STR);
		$result->bindParam(':fixed', $data['закреплен'], \PDO::PARAM_INT);
		$result->bindParam(':main_post', $data['главная новость'], \PDO::PARAM_INT);

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
	 * Метод преобразует дату в нужный формат.
	 * Принимает аргументом дату и возвращает
	 * отформатированный вариант
	 ********************************/

	public function getDate($arg)
	{
		$date = date("d/m/Y", strtotime($arg));
		return $date;
	}


	/********************************
	 * Метод добавляет картинку в пост.
	 * Принимает аргументом id поста и возвращает
	 * true либо false
	 ********************************/

	public function setFile($id)
	{
		$image = File::uploadFile();

		if ($image) {

			$sql = "UPDATE `post` SET `image`= :image WHERE `id` = :id";

			$result = self::$link->prepare($sql);
			$result->bindParam(':id', $id, \PDO::PARAM_STR);
			$result->bindParam(':image', $image, \PDO::PARAM_STR);
			return $result->execute();
		}
		return false;
	}

	/********************************
	 * Метод считывает данные из формы.
	 * Не принимает аргументов и возвращает
	 * массив
	 ********************************/

	public function getData()
	{
		if (isset($_POST['submit'])) {

			$title          =  $_POST['title'] ?? false;
			$description    =  $_POST['description'] ?? false;
			$keyword        =  $_POST['keyword'] ?? false;
			$category_id    =  $_POST['category_id'] ?? false;
			$story          =  $_POST['story'] ?? false;
			$fixed			=  $_POST['fixed'] ?? false;
			$main_post		=  $_POST['main'] ?? false;
			$author_id      =  $_SESSION['id'] ?? false;

			$data = [
				'заголовок'         => $title,
				'описание'          => $description,
				'ключевые слова'    => $keyword,
				'категория'         => $category_id,
				'текст поста'       => $story,
				'автор' 			=> $author_id,
				'закреплен'			=> $fixed,
				'главная новость'	=> $main_post
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
			// Список полей,которые не проверяем
			if (($arr[$key] !== $arr['закреплен']) and ($arr[$key] !== $arr['главная новость'])) {
				if (empty($arr[$key])) {
					$error[] = 'Поле ' . '<b>' . $key . '</b>' . ' не может быть пустым!';
				}
			}
		}
		return $error;
	}
}
