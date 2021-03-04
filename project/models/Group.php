<?php

namespace Project\Models;

use \Core\Model;

class Group extends Model
{

    /********************************
     * Права на доступ.
     * Аргументом является уровень прав
     ********************************/

    public static function is_role($level)
    {
        $model = new Model();

        // Если сессия существует
        if (isset($_SESSION['id'])) {

            // ID сессии
            $sessionID = intval($_SESSION['id']);

            // Запрос в базу на получение группы
            $user = $model->findOne("SELECT group_id FROM user WHERE id = $sessionID");

            // Преобразование типа
            $groupID = intval($user['group_id']);

            // Если уровень группы выше или равен
            if ($groupID <= $level) {
                return true;
            }
            return false;
        }
        return false;
    }
}
