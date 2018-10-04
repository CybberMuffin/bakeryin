<?php

namespace application\core;
use application\core\View;
abstract class Controller
{
    protected $route;
    protected $view;
    protected $model;
    protected $acc;

    public function __construct($route)
    {
        $this->route = $route;
        $this->model = $this->loadModel($route['controller']);
        if(!$this->checkAccount()){
            View::errorCode(403);
        }
        $this->view = new View($route);
    }

    private function loadModel($name)
    {
        $path = 'application\model\\'.ucfirst($name);
        if(class_exists($path)){
            return new $path;
        }
    }

    private function checkAccount()
    {
        $this->acc = require 'application/acc/'.$this->route['controller'].'.php';
        if($this->isAcc('all')){
            return true;
        } elseif(isset($_SESSION['logged_user']) and $this->isAcc('authorized')){
            return true;
        } elseif(!isset($_SESSION['logged_user']) and $this->isAcc('guest')){
            return true;
        } elseif(isset($_SESSION['admin']) and $this->isAcc('admin')){
            return true;
        }
        return false;
    }

    private function isAcc($key)
    {
        return in_array($this->route['action'], $this->acc[$key]);
    }

}