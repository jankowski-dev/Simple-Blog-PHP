<?php

namespace Project\Models;

use \Core\Model;

class Hello extends Model
{

	public function getById($id)
	{
		return $this->findOne("SELECT id, name FROM user WHERE id=$id");
	}

	public function getAll()
	{
		return $this->findMany("SELECT id, name FROM user");
	}
}
