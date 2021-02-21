<?php

namespace Project\Models;

use \Core\Model;

class Hello extends Model
{

	public function getById($id)
	{
		return $this->findOne("SELECT user_id, name FROM user WHERE user_id=$id");
	}

	public function getAll()
	{
		return $this->findMany("SELECT id, name FROM user");
	}
}
