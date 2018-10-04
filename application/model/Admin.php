<?php
namespace application\model;
use application\core\Model;

class Admin extends Model
{
    public function __construct(array $attr = [], bool $isNew = true)
    {
        parent::__construct($attr, $isNew);
        $this->idField = 'login';
    }
}