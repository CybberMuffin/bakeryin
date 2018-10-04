<?php
namespace application\model;
use application\core\Model;

class Product extends Model
{
    private $category;

    public function __construct(array $attr = [], bool $isNew = true)
    {
        parent::__construct($attr, $isNew);
        $this->category = new Categorie();
    }

    public function getCategoryName($id)
    {
        $this->category->find('id', $id);
        return $this->category->category;
    }

    public function getCategoryId($name)
    {
        $this->category->find('category', $name);
        return $this->category->id;
    }
}