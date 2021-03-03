<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Post;
use \Project\Models\Group;
use \Project\Models\Category;

class PostController extends Controller
{
    public static $group;


    public function __construct()
    {
        self::$group = new Group();
    }


    /********************************
     * Индексный метод админпанели.
     * Проверяет права доступа и
     * реализует функционал
     ********************************/

    public function index()
    {
        $this->title = 'cPanel: Посты';
        $errors = false;

        if (self::$group->is_role(1)) {

            $post = new Post();
            $category = new Category();

            // Получаем список всех постов и категорий
            $getPosts = $post->getPostAll();
            $getCategories = $category->getCategoryAll();

            // Массовое удаление постов
            $this->deletePostAll();

            // Загружаем представление
            return $this->render('admin/post/index', [
                'posts'         => $getPosts,
                'categories'    => $getCategories
            ]);
        }
        // В ином случаем перенаправляем его на форму
        header('Location: /auth/');
        exit;
    }


    /********************************
     * Редактирование поста.
     * Принимает данные из формы и
     * изменяет пост
     ********************************/

    public function editPost($arg)
    {
        $this->title = 'cPanel: Редактирование поста';
        $errors = false;
        $update = false;

        // Пользователь авторизован?
        if (self::$group->is_role(1)) {

            // Вытаскиваем данные
            $post = new Post();
            $category = new Category();
            $postItem = $post->getPostById($arg['id']);
            $categories = $category->getCategoryAll();

            // Сохранение поста
            if (isset($_POST['submit'])) {

                $title          =  $_POST['title'];
                $description    =  $_POST['description'];
                $keyword        =  $_POST['keyword'];
                $category_id    =  $_POST['category_id'];
                $story          =  $_POST['story'];

                $parameters = [
                    'заголовок'         => $title,
                    'описание'          => $description,
                    'ключевые слова'    => $keyword,
                    'категория'         => $category_id,
                    'текст поста'       => $story
                ];

                // Проверка на валидность полей
                $errors = $post->notEmpty($parameters);

                // Отправляем отредактированные данные в базу
                if ($errors == false) {
                    $update = $post->update($arg['id'], $title, $category_id, $description, $keyword, $story);
                }
            }

            // Загружаем представление
            return $this->render('admin/post/editPost', [
                'post'        => $postItem,
                'categories'  => $categories,
                'errors'      => $errors,
                'update'      => $update
            ]);
        }

        header('Location: /auth/');
        exit;
    }


    /********************************
     * Создание поста.
     * Принимает данные из формы и
     * создает пост
     ********************************/

    public function createPost()
    {
        $this->title = 'cPanel: Создание поста';
        $errors = false;
        $create = false;

        if (self::$group->is_role(1)) {

            $post = new Post();
            $category = new Category();
            $categories = $category->getCategoryAll();

            // Сохранение поста
            if (isset($_POST['submit'])) {

                $title          =  $_POST['title'];
                $description    =  $_POST['description'];
                $keyword        =  $_POST['keyword'];
                $category_id    =  $_POST['category_id'];
                $story          =  $_POST['story'];
                $author_id      =  $_SESSION['id'];

                $parameters = [
                    'заголовок'         => $title,
                    'описание'          => $description,
                    'ключевые слова'    => $keyword,
                    'категория'         => $category_id,
                    'текст поста'       => $story
                ];

                // Проверка на валидность полей
                $errors = $post->notEmpty($parameters);

                // Отправка данных и создание нового поста
                if ($errors == false) {
                    $create = $post->create($title, $category_id, $description, $keyword, $story, $author_id);
                }
            }

            return $this->render('admin/post/createPost', [
                'errors'        => $errors,
                'categories'    => $categories,
                'create'        => $create
            ]);
        }

        header('Location: /auth/');
        exit;
    }


    /********************************
     * Одиночное удаление поста.
     * Принимает аргументом id поста и  --------   Удаление только с правами
     * удаляет
     ********************************/

    public function deletePost($arg)
    {
        $post = new Post();
        $result = $post->delete($arg['id']);
        if ($result) {
            header('Location: /cpanel/posts/');
            exit;
        }
    }


    /********************************
     * Массовое удаление постов.
     * Принимает данные из checkbox,  --------   Удаление только с правами
     * и циклом удаляет посты
     ********************************/

    public function deletePostAll()
    {
        $post = new Post();
        $arrayPostId = false;

        if (isset($_POST['submit']) && isset($_POST['checkbox'])) {

            $arrayPostId = $_POST['checkbox'];

            foreach ($arrayPostId as $item) {
                $result = $post->delete($item);
            }

            header('Location: /cpanel/posts/');
            exit;
        }
    }
}
