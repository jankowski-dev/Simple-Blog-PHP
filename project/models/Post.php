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
	 * Метод обрабатывает и сортирует посты.
	 * Принимает аргументом массив данных из базы
	 * Возвращает массив сортированных данных
	 ********************************/

	public function handlerPost($posts)
	{
		// Сортируем массив данных от свежих постов к старым
		$sort = usort($posts, 'sortDateDesc');

		// Значения по умолчанию
		$fixedPost = false;
		$mainPost = $posts[0];


		// Ищем посты с пометкой "Главная новость"
		foreach ($posts as $post) {
			// Если находим соответствие
			if ($post['main_post'] == 1) {
				// Создаем пост для главной
				$mainPost = $post;
				// Удаляем его из основной выборки
				foreach ($posts as $key => $value) {
					if ($value['id'] == $post['id']) {
						unset($posts[$key]);
					}
				}
				break;
			}
		}

		// Ищем посты с пометкой "Закрепить"
		foreach ($posts as $post) {
			// Если находим соответствие
			if ($post['fixed'] == 1) {
				// Добавляем посты в массив
				$fixedPost[] = $post;
				// Удаляем его из основной выборки
				foreach ($posts as $key => $value) {
					if ($value['id'] == $post['id']) {
						unset($posts[$key]);
					}
				}
			}
		}


		return $data = [
			'mainPost' 	=> $mainPost,
			'fixedPost' => $fixedPost,
			'allPosts'	=> $posts
		];
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
	 * Метод делает запись в базу данных.
	 * Аргументом принимает массив с данными
	 ********************************/

	public function create($data)
	{

		$sql = "INSERT INTO post (title, category_id, description, keyword, story, author_id, fixed, main_post)
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
