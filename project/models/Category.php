<?php

	namespace Project\Models;

	use \Core\Model;

	class Category extends Model
	{

		public function getCategoryById($id)
		{
			return $this->findOne("SELECT * FROM category WHERE id=$id");
		}

		public function getCategoryAll()
		{
			return $this->findMany("SELECT * FROM category");
		}
	}
