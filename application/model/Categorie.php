<?php

namespace application\model;
use application\core\Model;

class Categorie extends Model
{
    public function getId($name)
    {
        $this->find('category', $name);
        return $this->id;
    }
}