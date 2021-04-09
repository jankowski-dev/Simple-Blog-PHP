<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Post;
use \Project\Models\Group;
use \Project\Models\Category;
use \Project\Models\File;

class PostController extends Controller
{
    public $post;
    public $category;
    public $group;
    public $file;

    public $errors  = false;
    public $update  = false;
    public $create  = false;

    public function __construct()
    {
        $this->post     = new Post();
        $this->category = new Category();
        $this->group    = new Group();
        $this->file     = new File();
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
        if ($this->group->user()) {

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
        if ($this->group->admin()) {

            // Получение данных поста
            $postItem = $this->post->getPostById($arg['id']);
            // $fileItem = $this->file->getFile($arg['id']);

            if ($postItem) {
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

                        // Обновляем данные в базе
                        $this->update = $this->post->update($arg['id'], $data);

                        // Обновляем данные изображения в базе
                        $this->post->setFile($arg['id']);
                    }
                }
                // Загружаем представление
                return $this->render('admin/post/editPost', [
                    'post'        => $postItem,
                    'categories'  => $categories,
                    'errors'      => $this->errors,
                    'update'      => $this->update
                ]);
            }
        }

        header('Location: /');
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
        if ($this->group->admin()) {

            // Получение списка категорий
            $categories = $this->category->getCategories();

            // Получение данных из формы
            $data = $this->post->getData();
            cast_print($data);

            // Проверяем на соответствие и ошибки
            if ($data) {
                $this->errors = $this->post->valPost($data);

                // Если ошибок нет, записываем данные в базу
                if (!$this->errors) {

                    // Записываем в базу данные из полей
                    $this->create = $this->post->create($data);

                    // Записываем в базу данные изображения
                    $this->post->setFile($this->create);
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
        $this->message = 'У вас нет прав на эту операцию';
        $subDelete = $_POST['subDelete'] ?? false;

        if ($this->group->admin()) {
            if ($subDelete) {
                foreach ($subDelete as $item) {
                    $this->post->delete($item);
                }
                header('Location: /cpanel/posts/');
                exit;
            }
        }
    }
}
