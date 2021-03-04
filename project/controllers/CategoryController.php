<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Category;
use \Project\Models\Group;

class CategoryController extends Controller
{
    public static $group;


    /********************************
     * Конструктор.
     * Создаем экземпляр класса Group
     * для проверки прав
     ********************************/

    public function __construct()
    {
        self::$group = new Group();
    }

    /********************************
     * Индексный метод категорий.
     * Проверяет права доступа и
     * реализует функционал
     ********************************/

    public function index()
    {
        $this->title = 'cPanel: Категории';
        $errors = false;

        // Если пользователь авторизован
        if (Group::is_role(1)) {

            $category = new Category();

            // Получаем список всех категорий
            $getCategories = $category->getCategoryAll();

            // Массовое удаление постов
            $this->deleteCategoryAll();

            // Загружаем представление
            return $this->render('admin/category/index', [
                'categories'     => $getCategories
            ]);
        }

        // В ином случаем перенаправляем его
        header('Location: /');
        exit;
    }


    /********************************
     * Создание категории.
     * Принимает данные из формы и
     * создает категорию
     ********************************/

    public function createCategory()
    {
        $this->title = 'cPanel: Создание категории';
        $errors = false;
        $create = false;

        if (Group::is_role(1)) {

            $category = new Category();
            // $categories = $category->getCategoryAll();

            // Сохранение поста
            if (isset($_POST['submit'])) {

                $title          =  $_POST['title'];
                $description    =  $_POST['description'];

                $parameters = [
                    'заголовок'         => $title,
                    'описание'          => $description,
                ];

                // Проверка на валидность полей
                $errors = $category->notEmpty($parameters);

                // Отправка данных и создание нового поста
                if ($errors == false) {
                    $create = $category->create($title, $description);
                }
            }

            return $this->render('admin/category/createCategory', [
                'errors'        => $errors,
                'create'        => $create
            ]);
        }

        header('Location: /auth/');
        exit;
    }


    /********************************
     * Редактирование категории.
     * Принимает данные из формы и
     * изменяет категорию
     ********************************/

    public function editCategory($arg)
    {
        $this->title = 'cPanel: Редактирование категории';
        $errors = false;
        $update = false;

        // Пользователь авторизован?
        if (Group::is_role(1)) {

            // Вытаскиваем данные
            $category = new Category();
            $categoryItem = $category->getCategoryById($arg['id']);

            // Сохранение поста
            if (isset($_POST['submit'])) {

                $title          =  $_POST['title'];
                $description    =  $_POST['description'];

                $parameters = [
                    'заголовок'         => $title,
                    'описание'          => $description
                ];

                // Проверка на валидность полей
                $errors = $category->notEmpty($parameters);

                // Отправляем отредактированные данные в базу
                if ($errors == false) {
                    $update = $category->update($arg['id'], $title, $description);
                }
            }

            // Загружаем представление
            return $this->render('admin/category/editCategory', [
                'category'      => $categoryItem,
                'errors'        => $errors,
                'update'        => $update
            ]);
        }

        header('Location: /');
        exit;
    }


    /********************************
     * Одиночное удаление категории.
     * Принимает аргументом id категории и  --------   Удаление только с правами
     * удаляет
     ********************************/

    public function deleteCategory($arg)
    {
        $category = new Category();
        $result = $category->delete($arg['id']);
        if ($result) {
            header('Location: /cpanel/categories/');
            exit;
        }
    }


    /********************************
     * Массовое удаление категорий.
     * Принимает данные из checkbox,  --------   Удаление только с правами
     * и циклом удаляет категории
     ********************************/

    public function deleteCategoryAll()
    {
        $category = new Category();
        $arrayCategoryId = false;

        if (isset($_POST['submit']) && isset($_POST['checkbox'])) {

            $arrayCategoryId = $_POST['checkbox'];

            foreach ($arrayCategoryId as $item) {
                $result = $category->delete($item);
            }

            header('Location: /cpanel/categories/');
            exit;
        }
    }
}
