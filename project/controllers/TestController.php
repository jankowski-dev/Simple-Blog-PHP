<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Post;
use \Project\Models\Group;
use \Project\Models\Category;

class TestController extends Controller
{
    public $post;
    public $category;
    public $group;

    public $update  = false;
    public $create  = false;

    public function __construct()
    {
        $this->post     = new Post();
        $this->category = new Category();
        $this->group    = new Group();
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
        if ($this->group->admin()) {

            // Получение списка категорий
            $categories = $this->category->getCategories();

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

                for ($i = 1; $i <= 3; $i++) {
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
     * Метод массового создания категорий.
     * Принимает статические данные и циклом
     * добавлет новые посты в базу
     ********************************/

    public function createCategoryTest()
    {
        // Тайтл страницы
        $this->title = 'cPanel: Создание категории';

        // Проверка прав на действия
        if ($this->group->admin()) {

            $data = [
                'заголовок'    => 'Заголовок' . mt_rand(1, 99),
                'описание'     => 'Описания' . mt_rand(1, 99)
            ];

            // Если ошибок нет, записываем данные в базу
            for ($i = 1; $i <= 3; $i++) {
                $this->create = $this->category->create($data);
            }
        }

        // Загрузка представления
            header('Location: /cpanel/categories/');
            exit;

        // В ином случаем перенаправляем
        header('Location: /auth/');
        exit;
    }
}
