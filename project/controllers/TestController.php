<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Post;
use \Project\Models\User;
use \Project\Models\Group;
use \Project\Models\Category;

class TestController extends Controller
{
    public $post;
    public $user;
    public $category;

    public $errors  = false;
    public $update  = false;
    public $create  = false;
    public $message = false;

    public function __construct()
    {
        $this->post     = new Post();
        $this->user     = new User();
        $this->category = new Category();
    }


    /********************************
     * Метод массового создания постов.
     * Принимает статические данные и циклом
     * добавлет новые посты в базу
     ********************************/

    public function createPostTest()
    {
        // Тайтл страницы
        $this->title = 'cPanel: Создание поста';

        // Проверка прав на действия
        if (Group::is_role(1)) {

            // Получение списка категорий
            $categories = $this->category->getCategoryAll();

            // Транспартируем данные из формы
            $data = [
                'заголовок'         => 'Заголовок' . mt_rand(1, 99),
                'описание'          => 'Описание' . mt_rand(1, 99),
                'ключевые слова'    => 'Ключевые слова' . mt_rand(1, 99),
                'категория'         => mt_rand(1, 3),
                'текст поста'       => 'Какойто текст' . mt_rand(1, 99),
                'автор'             => mt_rand(1, 3)
            ];

            // Проверяем на соответствие и ошибки
            if ($data) {
                $this->errors = $this->post->valPost($data);
            }

            // Если ошибок нет, pаписываем данные в базу
            if (!$this->errors) {

                for ($i = 1; $i <= 2; $i++) {
                    $this->create = $this->post->create($data);
                }
            }

            header('Location: /cpanel/posts/');
            exit;
        }

        // В ином случаем перенаправляем
        header('Location: /auth/');
        exit;
    }


    /********************************
     * Метод массового создания постов.
     * Принимает статические данные и циклом
     * добавлет новые посты в базу
     ********************************/

    public function createCategoryTest()
    {
        $this->title = 'Тестовое создание поста';
        $errors = false;
        $create = false;

        if (Group::is_role(1)) {

            $category = new Category();

            // Сохранение поста
            $title          =  'Тестовый заголовок';
            $description    =  'Тестовое описание';

            $parameters = [
                'заголовок'         => $title,
                'описание'          => $description
            ];

            // Отправка данных и создание нового поста
            for ($i = 1; $i <= 1; $i++) {
                $create = $category->create($title, $description);
            }

            header('Location: /cpanel/categories/');
            exit;
        }

        header('Location: /auth/');
        exit;
    }
}
