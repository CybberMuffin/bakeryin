<?php
namespace application\model;
use application\core\Model;

class User extends Model
{
    public function getAllInfo()
    {
        $string = "Id => " . $this->id
            . "\nLogin => " . $this->login
            . "\nEmail => " . $this->email
            . "\nPassword => " . $this->password;
        return $string;
    }

    public function getTableName()
    {
        return $this->table;
    }
}