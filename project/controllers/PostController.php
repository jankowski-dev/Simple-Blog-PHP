<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Post;
use \Project\Models\Group;
use \Project\Models\Category;

class PostController extends Controller
{
    public $post;
    public $category;

    public $errors  = false;
    public $update  = false;
    public $create  = false;

    public function __construct()
    {
        $this->post     = new Post();
        $this->category = new Category();
    }


    /********************************
     * Индексный метод.
     * Проверяет права доступа и
     * реализует функционал
     ********************************/

    public function index()
    {
        // Тайтл страницы
        $this->title = 'cPanel: Посты';

        // Проверка прав на действия
        if (Group::is_role(1)) {

            // Получаем список всех постов
            $getPosts = $this->post->getPosts();

            // Удаление постов
            $this->deletePost();

            // Загружаем представление
            return $this->render('admin/post/index', [
                'posts'         => $getPosts
            ]);
        }

        // В ином случаем перенаправляем
        header('Location: /');
        exit;
    }


    /********************************
     * Метод редактирования поста.
     * Не принимает аргументов
     ********************************/

    public function editPost($arg)
    {
        $this->title = 'cPanel: Редактирование поста';

        // Проверка прав на действия
        if (Group::is_role(1)) {

            // Получение данных поста
            $postItem = $this->post->getPostById($arg['id']);

            // Получение списка категорий
            $categories = $this->category->getCategories();

            // Транспартируем данные из формы
            $data = $this->post->getData();

            // Если данные пришли из формы
            if ($data) {

                // Проверка данных из формы
                $this->errors = $this->post->valPost($data);

                // Проверка данных на ошибки
                if (!$this->errors) {

                    // Запись данных в базу
                    $this->update = $this->post->update($arg['id'], $data);
                }
            }
        }

        // Загружаем представление
        return $this->render('admin/post/editPost', [
            'post'        => $postItem,
            'categories'  => $categories,
            'errors'      => $this->errors,
            'update'      => $this->update
        ]);


        header('Location: /auth/');
        exit;
    }


    /********************************
     * Метод создание поста.
     * Не принимает аргументов
     ********************************/

    public function createPost()
    {
        // Тайтл страницы
        $this->title = 'cPanel: Создание поста';

        // Проверка прав на действия
        if (Group::is_role(1)) {

            // Получение списка категорий
            $categories = $this->category->getCategories();

            // Получение данных из формы
            $data = $this->post->getData();

            // Проверяем на соответствие и ошибки
            if ($data) {
                $this->errors = $this->post->valPost($data);

                // Если ошибок нет, записываем данные в базу
                if (!$this->errors) {
                    $this->create = $this->post->create($data);
                }
            }

            // Загрузка представления
            return $this->render('admin/post/createPost', [
                'categories'    => $categories,
                'errors'        => $this->errors,
                'create'        => $this->create
            ]);
        }

        // В ином случаем перенаправляем
        header('Location: /auth/');
        exit;
    }


    /********************************
     * Метод удаления постов.
     * Не принимает аргументов
     ********************************/

    public function deletePost()
    {
        $subDelete = $_POST['subDelete'] ?? false;

        if ($subDelete) {
            foreach ($subDelete as $item) {
                $this->post->delete($item);
            }
            header('Location: /cpanel/posts/');
            exit;
        }
    }
}
