<?php

namespace Project\Models;

use \Core\Model;

class Group extends Model
{

    /********************************
     * Права на доступ.
     * Аргументом является уровень прав
     ********************************/

    public function is_role($level)
    {
        // ID сессии
        $sessionID = intval($_SESSION['id']);
        // Получение id группы пользователя
        $user = $this->findOne("SELECT group_id FROM user WHERE id = $sessionID");
        // Преобразование типа
        $groupID = intval($user['group_id']);

        // Если уровень группы выше или равен
        if ($groupID <= $level) {
            return true;
            // Иначе доступ закрыт
        } else {
            return false;
        }
    }
}
