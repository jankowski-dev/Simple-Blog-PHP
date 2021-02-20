<?php

namespace Project\Config;

class DB
{
    // Хранит экземпляр данного класса
    static private $_instance;

    // Приватный конструктор, запрещающий создавать объект напрямую
    private function __construct() {}

    // Приватный магический мотод клонирования, запрещающий клонировать объект напрямую
    private function __clone() {}


    // Singleton pattern
    static public function getInstance() {
        // Если свойство является экземпляром данного класса
        if (self::$_instance instanceof self) {
            // тогда вернуть его
            return self::$_instance;
        }
        // Если же нет, создать новый экземпляр этого класса
        return self::$_instance = new self;
        }

    // Соединение с базой данных
    public function getConnection()
    {
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
        $db = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        return $db;
    }
}