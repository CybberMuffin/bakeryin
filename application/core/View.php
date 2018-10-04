<?php

namespace application\core;

class View
{
    private $path;
    private $route;
    private $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = '';
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($title, $vars = [])
    {
        extract($vars);
        ob_start();
        if(file_exists('application/view/'.$this->path.'.php')){
            require 'application/view/'.$this->path.'.php';
            $content = ob_get_clean();
            if(strcmp($this->path, 'pages/admin') == 0){
                require 'application/view/layouts/admin.php';
            } else {
                require 'application/view/layouts/' . $this->layout . '.php';
            }
        }
    }

    public function redirect($url)
    {
        header('location: '.$url);
    }

    public static function  errorCode($code)
    {
        http_response_code($code);
        $path = 'application/view/errors/'.$code.'.php';
        if(file_exists($path)){
            require $path;
        }
        exit();
    }

    public function message($status, $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

}