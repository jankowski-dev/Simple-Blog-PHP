<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Category;
use \Project\Models\Group;

class CategoryController extends Controller
{
    public $category;

    public $errors  = false;
    public $create = false;
    public $update = false;
    public $message = false;

    public function __construct()
    {
        $this->category = new Category();
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

            // Получаем список всех категорий
            $getCategories = $this->category->getCategories();

            // Массовое удаление постов
            $this->deleteCategory();

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
        // Тайтл страницы
        $this->title = 'cPanel: Создание категории';

        // Проверка прав на действия
        if (Group::is_role(1)) {

            // Получение данных из формы
            $data = $this->category->getData();

            // Проверяем на соотвествия и ошибки
            if ($data) {
                $this->errors = $this->category->valCategory($data);

                // Если ошибок нет, записываем данные в базу
                if (!$this->errors) {
                    $this->create = $this->category->create($data);
                }
            }

            // Загрузка представления
            return $this->render('admin/category/createCategory', [
                'errors'        => $this->errors,
                'create'        => $this->create
            ]);
        }

        // В ином случаем перенаправляем
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

        if (Group::is_role(1)) {

            // Получение данных из формы
            $data = $this->category->getData();

            // Получение данных категории
            $categoryItem = $this->category->getCategoryById($arg['id']);

            cast_print($categoryItem);

            // Проверяем на соответствия и ошибки
            if ($data) {
                $this->errors = $this->category->valCategory($data);

                // Если ошибок нет, записываем данные в базу
                if (!$this->errors) {
                    $this->update = $this->category->update($arg['id'], $data);
                }
            }

            // Загружаем представление
            return $this->render('admin/category/editCategory', [
                'category'      => $categoryItem,
                'errors'        => $this->errors,
                'update'        => $this->update
            ]);
        }

        header('Location: /');
        exit;
    }


    /********************************
     * Метод удаления категорий.
     * Не принимает аргументов
     ********************************/

    public function deleteCategory()
    {
        $subDelete = $_POST['subDelete'] ?? false;

        if ($subDelete) {
            foreach ($subDelete as $item) {
                $this->category->delete($item);
            }
            header('Location: /cpanel/categories/');
            exit;
        }
    }
}
