<?php

namespace Project\Models;

use \Core\Model;

class Group extends Model
{
    public $model;
    public $group;

    public function __construct()
    {
        $this->model = new Model();

        if (isset($_SESSION['id'])) {
            $sessionID = intval($_SESSION['id']);
            $user = $this->model->findOne("SELECT group_id FROM user WHERE id = $sessionID");
            $this->group = intval($user['group_id']);
        }
    }

    /********************************
     * Права на доступ.
     * Аргументом является уровень прав
     ********************************/

    public function admin()
    {
        if (isset($_SESSION['id'])) {
            $result = ($this->group == 1) ? true : false;
            return $result;
        }
        return false;
    }

    public function manager()
    {
        if (isset($_SESSION['id'])) {
            $result = ($this->group == 2 or $this->group == 1) ? true : false;
            return $result;
        }
        return false;
    }

    public function user()
    {
        if (isset($_SESSION['id'])) {
            $result = ($this->group == 3 or $this->group == 2 or $this->group == 1) ? true : false;
            return $result;
        }
        return false;
    }

    public static function guest()
    {
        $result = !isset($_SESSION['id']) ? true : false;
        return $result;
    }
}
