<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Auth;
use \Project\Models\Group;

class AuthController extends Controller
{
    public $user;
    public $group;
    public $auth;
    public $errors = false;
    public $message = false;


    public function __construct()
    {
        $this->auth = new Auth();
        $this->group = new Group();
    }


    /********************************
     * Метод авторизации на сайте.
     ********************************/

    public function auth()
    {
        // Тайтл страницы
        $this->title    = 'Форма авторизации';
        // Сообщение о успешной регистрации
        $this->message  = 'Вы успешно авторизованы';
        // Проверка прав
        if ($this->group->guest()) {
            // Получение данных из формы
            $data = $this->auth->getData();
            if ($data) {
                // Проверка данных в базе данных
                $userID = $this->auth->checkUser($data);
                // Если идентификация прошла успешно...
                if ($userID) {
                    // Авторизируем пользователя
                    $this->auth->authUser($userID);
                    // Загрузка представления успешной авторизации
                    return $this->render('info/message', [
                        'message'    => $this->message
                    ]);
                }
                $this->errors[] = 'Неверные данные для входа';
            }
            // Загрузка представления с ошибкой в форме
            return $this->render('auth/auth', [
                'errors'    => $this->errors
            ]);
        }
        $this->message = 'Вы УЖЕ авторизованы!';
        // Загрузка представления, когда уже авторизован
        return $this->render('info/message', [
            'message'    => $this->message
        ]);
    }



    /********************************
     * Метод регистрации на сайте.
     ********************************/

    public function register()
    {
        // Тайтл страницы
        $this->title = 'Форма регистрации';
        if ($this->group->guest()) {
            // Получение данных из формы
            $data = $this->auth->getData();
            // Если данные пришли из формы
            if ($data) {
                // Проверяем на ошибки
                $this->errors = $this->auth->valRegister($data);
                // Если ошибок нет
                if (!$this->errors) {
                    // Регистрируем нового пользователя
                    $this->auth->register($data);
                    // Сообщение о успешной регистрации
                    $this->message = 'Вы успешно зарегистрированы!';
                    // Загрузка представления успешной регистрации
                    return $this->render('info/message', [
                        'message'    => $this->message
                    ]);
                }
            }
            // Загрузка представления с формой
            return $this->render('auth/register', [
                'errors'    => $this->errors,
            ]);
        }
        // Сообщение о успешной регистрации
        $this->message = 'Вы УЖЕ зарегистрированы!';
        // Загрузка представления
        return $this->render('info/message', [
            'message'    => $this->message
        ]);
    }


    /********************************
     * Метод разавторизации на сайте.
     ********************************/

    public function logout()
    {
        $result = $this->auth->userLogout();
        if ($result) {
            header('Location: /auth/');
            exit;
        }
    }
}
