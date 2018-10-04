<?php
namespace application\model;
use application\core\Model;


class Order extends Model
{
    public function getProductName($id){
        $product = new Product();
        $product->find('id', $id);
        return $product->name;
    }

    public function getUserLogin($id){
        $user = new User();
        $user->find('id', $id);
        return $user->login;
    }
}